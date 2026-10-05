<?php

namespace App\Pam\Core;

use App\Pam\Authentication\Entity\PamUser;
use App\Shared\Api\PamException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/** Persistent local behavior. Unsupported vendor workflows remain explicit 501s. */
final class CoreService
{
    private const PERMISSIONS = ['useAccounts', 'retrieveAccounts', 'listAccounts', 'addAccounts', 'updateAccountContent', 'updateAccountProperties', 'initiateCPMAccountManagementOperations', 'specifyNextAccountContent', 'renameAccounts', 'deleteAccounts', 'unlockAccounts', 'manageSafe', 'manageSafeMembers', 'backupSafe', 'viewAuditLog', 'viewSafeMembers', 'accessWithoutConfirmation', 'createFolders', 'deleteFolders', 'moveAccountsAndFolders', 'requestsAuthorizationLevel1', 'requestsAuthorizationLevel2'];

    public function __construct(private readonly ObjectStore $store)
    {
    }

    public function handle(Request $request, PamUser $actor): Response
    {
        // Serialize writes to keep simulator name uniqueness and relationships atomic.
        $db = $this->store->em->getConnection();
        $db->beginTransaction();
        try {
            $this->store->em->getConnection()->executeQuery('SELECT pg_advisory_xact_lock(72819421)');
            $parts = explode('/', trim(substr($request->getPathInfo(), strlen('/PasswordVault/API/')), '/'));
            $parts = array_map('rawurldecode', $parts);
            $kind = strtolower(array_shift($parts));
            $body = [];
            if ('' !== $request->getContent()) {
                if (!str_contains(strtolower($request->headers->get('Content-Type', '')), 'application/json') && !str_contains(strtolower($request->headers->get('Content-Type', '')), 'application/json-patch+json')) {
                    throw new PamException(415, 'PAMMOCK415', 'JSON content type required.');
                }
                try {
                    $body = json_decode($request->getContent(), true, 64, JSON_THROW_ON_ERROR);
                } catch (\JsonException) {
                    $this->bad('Malformed JSON.');
                }
                if (!is_array($body)) {
                    $this->bad('JSON object or patch array required.');
                }
                if ('PATCH' !== $request->getMethod() && !str_starts_with(ltrim($request->getContent()), '{')) {
                    $this->bad('JSON object required.');
                }
            }
            $response = match ($kind) {
                'users', 'currentuser', 'usertypes', 'loginsinfo' => $this->users($request, $actor, $kind, $parts, $body),
                'usergroups' => $this->groups($request, $actor, $parts, $body),
                'safes' => $this->safes($request, $actor, $parts, $body),
                'accounts' => $this->accounts($request, $actor, $parts, $body),
                'platforms', 'psm' => $this->platforms($request, $actor, $kind, $parts, $body),
                default => throw new PamException(501, 'PAMMOCK001', 'Workflow not implemented.'),
            };
            $response->headers->set('Cache-Control', 'no-store');
            $this->store->em->flush();
            $db->commit();

            return $response;
        } catch (\Throwable $error) {
            $db->rollBack();
            $this->store->em->clear();
            throw $error;
        }
    }

    private function bad(string $message): never
    {
        throw new PamException(400, 'PASWS013E', $message);
    }

    private function admin(PamUser $actor): bool
    {
        return in_array($actor->username, ['pamadmin', 'vaultadmin'], true);
    }

    private function requireAdmin(PamUser $actor): void
    {
        if (!$this->admin($actor)) {
            throw new PamException(403, 'PAMMOCK403', 'Vault administrator permission required.');
        }
    }

    /**
     * @param array<string, mixed> $body
     */
    private function required(array $body, string $key): string
    {
        if (!isset($body[$key]) || !is_string($body[$key]) || '' === trim($body[$key]) || strlen($body[$key]) > 255 || preg_match('/[\x00-\x1f]/', $body[$key])) {
            $this->bad($key.' must be a non-empty string of at most 255 characters without control characters.');
        }
        if (!in_array($key, ['initialPassword', 'newPassword', 'NewCredentials', 'secret', 'userName'], true) && (str_contains($body[$key], '/') || str_contains($body[$key], chr(92)))) {
            $this->bad($key.' cannot contain path separators.');
        }

        return $body[$key];
    }

    /**
     * @param array<string, mixed> $body
     * @param list<string>         $keys
     */
    private function booleans(array $body, array $keys): void
    {
        foreach ($keys as $key) {
            if (isset($body[$key]) && !is_bool($body[$key])) {
                $this->bad($key.' must be boolean.');
            }
        }
    }

    /**
     * @param array<string, mixed> $body
     * @param list<string>         $fields
     *
     * @return array<string, mixed>
     */
    private function fields(array $body, array $fields): array
    {
        return array_intersect_key($body, array_flip($fields));
    }

    /**
     * @param list<array<string, mixed>> $rows
     */
    private function listing(Request $r, array $rows, string $key = 'value', string $countKey = 'count'): JsonResponse
    {
        $search = strtolower((string) $r->query->get('search', ''));
        if ('' !== $search) {
            $rows = array_values(array_filter($rows, static fn (array $row): bool => str_contains(strtolower(json_encode($row, JSON_THROW_ON_ERROR)), $search)));
        }
        $filter = (string) $r->query->get('filter', '');
        if ('' !== $filter) {
            foreach (preg_split('/\s+and\s+/i', $filter) as $term) {
                if (!preg_match('/^(\w+)\s+eq\s+[\x27"]?([^\x27"]+)[\x27"]?$/i', trim($term), $m)) {
                    $this->bad('Only field eq value filters are supported.');
                }
                $rows = array_values(array_filter($rows, static function (array $row) use ($m): bool {
                    $row = array_change_key_case($row);
                    $value = $row[strtolower($m[1])] ?? null;

                    return strtolower(is_bool($value) ? ($value ? 'true' : 'false') : (string) $value) === strtolower(trim($m[2]));
                }));
            }
        }
        $sort = (string) $r->query->get('sort', '');
        if ('' !== $sort) {
            $terms = explode(',', $sort);
            usort($rows, static function (array $a, array $b) use ($terms): int {
                foreach ($terms as $term) {
                    $parts = preg_split('/\s+/', trim($term));
                    $key = strtolower($parts[0]);
                    $result = (array_change_key_case($a)[$key] ?? '') <=> (array_change_key_case($b)[$key] ?? '');
                    if ($result) {
                        return 'desc' === strtolower($parts[1] ?? '') ? -$result : $result;
                    }
                }

                return 0;
            });
        }
        $offset = $r->query->get('offset', $r->query->get('pageOffset', '0'));
        $limit = $r->query->get('limit', $r->query->get('pageSize', '100'));
        if (!ctype_digit((string) $offset) || !ctype_digit((string) $limit) || (int) $limit > 1000) {
            $this->bad('Pagination must use non-negative integers; maximum page size is 1000.');
        }

        return new JsonResponse([$key => array_slice($rows, (int) $offset, 0 === (int) $limit ? null : (int) $limit), $countKey => count($rows)]);
    }

    /**
     * @param array<string, mixed> $safe
     */
    private function allowed(PamUser $actor, array $safe, string $permission): bool
    {
        if ($this->admin($actor)) {
            return true;
        }
        $names = [strtolower($actor->username)];
        foreach ($this->store->all('groups') as $group) {
            foreach ($group['members'] as $member) {
                if (0 === strcasecmp($member['memberName'], $actor->username)) {
                    $names[] = strtolower($group['groupName']);
                }
            }
        }
        foreach ($this->store->all('memberships') as $member) {
            if ($member['safeName'] === $safe['safeName'] && ('Group' === $member['memberType'] ? in_array(strtolower($member['memberName']), array_slice($names, 1), true) : 0 === strcasecmp($member['memberName'], $actor->username)) && (null === ($member['membershipExpirationDate'] ?? null) || $member['membershipExpirationDate'] > time()) && ($member['permissions'][$permission] ?? false)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array<string, mixed> $safe
     */
    private function permit(PamUser $actor, array $safe, string $permission): void
    {
        if (!$this->allowed($actor, $safe, $permission)) {
            throw new PamException(403, 'PAMMOCK403', 'Missing safe permission: '.$permission);
        }
    }

    /**
     * @param array<string, mixed> $user
     *
     * @return array<string, mixed>
     */
    private function userView(array $user): array
    {
        $identity = $this->store->em->find(PamUser::class, $user['username']);
        $user['enableUser'] = 'disabled' !== $identity->state;
        $user['suspended'] = 'locked' === $identity->state;
        $user['groupsMembership'] = [];
        foreach ($this->store->all('groups') as $group) {
            foreach ($group['members'] as $member) {
                if ($member['memberName'] === $user['username']) {
                    $user['groupsMembership'][] = ['groupID' => $group['id'], 'groupName' => $group['groupName'], 'groupType' => 'Vault'];
                }
            }
        }

        return $user;
    }

    /**
     * @param list<string>         $p
     * @param array<string, mixed> $b
     */
    private function users(Request $r, PamUser $actor, string $kind, array $p, array $b): Response
    {
        if ('currentuser' === $kind) {
            return new JsonResponse($this->userView($this->store->get('users', $actor->username)));
        }
        $this->requireAdmin($actor);
        if ('usertypes' === $kind) {
            return new JsonResponse(['UserTypes' => [['ID' => 1, 'Name' => 'EPVUser'], ['ID' => 2, 'Name' => 'Built-InAdmins']]]);
        }
        if ('loginsinfo' === $kind) {
            return new JsonResponse(['isLoggedIn' => true, 'userName' => $actor->username]);
        }
        $method = $r->getMethod();
        if ([] === $p) {
            if ('GET' === $method) {
                return $this->listing($r, array_map($this->userView(...), $this->store->all('users')), 'Users', 'Total');
            }
            $name = $this->required($b, 'username');
            $password = $this->required($b, 'initialPassword');
            if (strlen($name) > 80) {
                $this->bad('username must not exceed 80 characters.');
            }
            $this->store->unique('users', 'username', $name);
            $this->booleans($b, ['enableUser']);
            $user = ['id' => $this->store->nextId('users'), 'username' => $name, 'source' => 'CyberArk', 'userType' => 'EPVUser', 'location' => '\\', 'componentUser' => false] + $this->fields($b, ['description', 'personalDetails', 'businessAddress', 'internet', 'phones']);
            $this->store->em->persist(new PamUser($name, 'CyberArk', password_hash($password, PASSWORD_ARGON2ID), 'API user', ($b['enableUser'] ?? true) ? 'active' : 'disabled'));
            $this->store->save('users', $user);

            return new JsonResponse($this->userView($user), 201);
        }
        $user = $this->store->get('users', $p[0]);
        $identity = $this->store->em->find(PamUser::class, $user['username']);
        $action = strtolower($p[1] ?? '');
        if ('safes' === $action) {
            return $this->listing($r, array_values(array_filter($this->store->all('safes'), fn (array $safe): bool => $this->allowed($identity, $safe, 'listAccounts'))));
        }
        if ('' !== $action) {
            if ('disable' === $action && in_array($identity->username, ['pamadmin', 'vaultadmin'], true)) {
                throw new PamException(409, 'PAMMOCK409', 'Built-in administrators cannot be disabled.');
            }
            if ('resetpassword' === $action) {
                $identity->passwordHash = password_hash($this->required($b, 'newPassword'), PASSWORD_ARGON2ID);
            } else {
                $identity->state = 'disable' === $action ? 'disabled' : 'active';
            }
            $this->store->em->getConnection()->executeStatement('DELETE FROM pam_session WHERE username = ?', [$identity->username]);

            return new JsonResponse(null, 204);
        }
        if ('GET' === $method) {
            return new JsonResponse($this->userView($user));
        }
        if (in_array($user['username'], ['pamadmin', 'vaultadmin'], true)) {
            throw new PamException(409, 'PAMMOCK409', 'Built-in administrators are protected in this simulator.');
        }
        if ('DELETE' === $method) {
            foreach ($this->store->all('groups') as $group) {
                $group['members'] = array_values(array_filter($group['members'], fn (array $member): bool => $member['memberName'] !== $user['username']));
                $this->store->save('groups', $group);
            }
            $this->removeMemberships($user['username'], 'User');
            $this->store->delete('users', (string) $user['id']);
            $this->store->em->remove($identity);

            return new JsonResponse(null, 204);
        }
        if (isset($b['username']) && $b['username'] !== $user['username']) {
            $this->bad('Renaming a user is not supported.');
        }
        $this->booleans($b, ['enableUser']);
        if (isset($b['enableUser'])) {
            $identity->state = $b['enableUser'] ? 'active' : 'disabled';
            if (!$b['enableUser']) {
                $this->store->em->getConnection()->executeStatement('DELETE FROM pam_session WHERE username = ?', [$identity->username]);
            }
        }
        $user = array_replace($user, $this->fields($b, ['description', 'personalDetails', 'businessAddress', 'internet', 'phones', 'location']));
        $this->store->save('users', $user);

        return new JsonResponse($this->userView($user));
    }

    private function removeMemberships(string $name, string $type): void
    {
        foreach ($this->store->all('memberships') as $member) {
            if ($member['memberType'] === $type && 0 === strcasecmp($member['memberName'], $name)) {
                $this->store->delete('memberships', (string) $member['id']);
            }
        }
    }

    /**
     * @param list<string>         $p
     * @param array<string, mixed> $b
     */
    private function groups(Request $r, PamUser $actor, array $p, array $b): Response
    {
        $this->requireAdmin($actor);
        $method = $r->getMethod();
        if ([] === $p) {
            if ('GET' === $method) {
                return $this->listing($r, $this->store->all('groups'));
            }
            $name = $this->required($b, 'groupName');
            $this->store->unique('groups', 'groupName', $name);
            $group = ['id' => $this->store->nextId('groups'), 'groupName' => $name, 'groupType' => 'Vault', 'description' => $b['description'] ?? '', 'location' => '\\', 'members' => []];
            $this->store->save('groups', $group);

            return new JsonResponse($group, 201);
        }
        $group = $this->store->get('groups', $p[0]);
        if ('members' === strtolower($p[1] ?? '')) {
            if ('POST' === $method) {
                if (isset($b['memberType']) && 'vault' !== strtolower((string) $b['memberType'])) {
                    $this->bad('Only local Vault members are supported.');
                }
                if (isset($b['memberId']) && is_int($b['memberId'])) {
                    $b['memberId'] = (string) $b['memberId'];
                }
                $user = $this->store->get('users', $this->required($b, 'memberId'));
                foreach ($group['members'] as $member) {
                    if ($member['memberName'] === $user['username']) {
                        throw new PamException(409, 'PAMMOCK409', 'Already a group member.');
                    }
                }
                $member = ['memberId' => $user['id'], 'memberName' => $user['username'], 'memberType' => 'Vault'];
                $group['members'][] = $member;
                $this->store->save('groups', $group);

                return new JsonResponse($member, 201);
            }
            $before = count($group['members']);
            $group['members'] = array_values(array_filter($group['members'], fn (array $member): bool => 0 !== strcasecmp($member['memberName'], $p[2])));
            if ($before === count($group['members'])) {
                throw new PamException(404, 'PAMMOCK404', 'Group member not found.');
            }
            $this->store->save('groups', $group);

            return new JsonResponse(null, 204);
        }
        if ('GET' === $method) {
            return new JsonResponse($group);
        }
        if ('DELETE' === $method) {
            $this->removeMemberships($group['groupName'], 'Group');
            $this->store->delete('groups', (string) $group['id']);

            return new JsonResponse(null, 204);
        }
        if (isset($b['groupName']) && $b['groupName'] !== $group['groupName']) {
            $name = $this->required($b, 'groupName');
            $this->store->unique('groups', 'groupName', $name, (string) $group['id']);
            foreach ($this->store->all('memberships') as $member) {
                if ('Group' === $member['memberType'] && $member['memberName'] === $group['groupName']) {
                    $member['memberName'] = $name;
                    $this->store->save('memberships', $member);
                }
            }
            $group['groupName'] = $name;
        }
        $group = array_replace($group, $this->fields($b, ['description', 'location']));
        $this->store->save('groups', $group);

        return new JsonResponse($group);
    }

    /**
     * @param list<string>         $p
     * @param array<string, mixed> $b
     */
    private function safes(Request $r, PamUser $actor, array $p, array $b): Response
    {
        $method = $r->getMethod();
        if ([] === $p) {
            if ('GET' === $method) {
                return $this->listing($r, array_values(array_filter($this->store->all('safes'), fn (array $safe): bool => $this->allowed($actor, $safe, 'listAccounts'))));
            }
            $this->requireAdmin($actor);
            $name = $this->required($b, 'safeName');
            $this->store->unique('safes', 'safeName', $name);
            $safe = ['id' => 'safe-'.bin2hex(random_bytes(6)), 'safeName' => $name, 'safeUrlId' => $name, 'creationTime' => time(), 'olacEnabled' => false, 'numberOfVersionsRetention' => 5, 'description' => ''];
        } else {
            $safe = $this->store->get('safes', $p[0]);
            if ('members' === strtolower($p[1] ?? '')) {
                return $this->members($r, $actor, $safe, array_slice($p, 2), $b);
            }
            $this->permit($actor, $safe, 'GET' === $method ? 'listAccounts' : 'manageSafe');
            if ('GET' === $method) {
                return new JsonResponse($safe);
            }
            if ('DELETE' === $method) {
                foreach ($this->store->all('accounts') as $account) {
                    if ($account['safeName'] === $safe['safeName']) {
                        throw new PamException(409, 'PAMMOCK409', 'Remove accounts before deleting their safe.');
                    }
                }
                foreach ($this->store->all('memberships') as $member) {
                    if ($member['safeName'] === $safe['safeName']) {
                        $this->store->delete('memberships', (string) $member['id']);
                    }
                }
                $this->store->delete('safes', $safe['id']);

                return new JsonResponse(null, 204);
            }
        }
        if (isset($b['oLACEnabled'])) {
            $b['olacEnabled'] = $b['oLACEnabled'];
        }
        $this->booleans($b, ['olacEnabled']);
        if (isset($b['numberOfDaysRetention'], $b['numberOfVersionsRetention'])) {
            $this->bad('Choose days or versions retention, not both.');
        }
        foreach (['numberOfDaysRetention', 'numberOfVersionsRetention'] as $field) {
            if (isset($b[$field]) && (!is_int($b[$field]) || $b[$field] < 0)) {
                $this->bad('Retention must be a non-negative integer.');
            }
        }
        if (isset($b['safeName']) && $b['safeName'] !== $safe['safeName']) {
            $name = $this->required($b, 'safeName');
            $this->store->unique('safes', 'safeName', $name, $safe['id']);
            foreach (['accounts', 'memberships'] as $relatedKind) {
                foreach ($this->store->all($relatedKind) as $related) {
                    if ($related['safeName'] === $safe['safeName']) {
                        $related['safeName'] = $name;
                        $this->store->save($relatedKind, $related);
                    }
                }
            }
            $safe['safeName'] = $name;
            $safe['safeUrlId'] = $name;
        }
        $safe = array_replace($safe, $this->fields($b, ['description', 'managingCPM', 'olacEnabled', 'numberOfDaysRetention', 'numberOfVersionsRetention']));
        if (isset($b['numberOfDaysRetention'])) {
            unset($safe['numberOfVersionsRetention']);
        }
        if (isset($b['numberOfVersionsRetention'])) {
            unset($safe['numberOfDaysRetention']);
        }
        $this->store->save('safes', $safe);

        return new JsonResponse($safe, [] === $p ? 201 : 200);
    }

    /**
     * @param array<string, mixed> $safe
     * @param list<string>         $p
     * @param array<string, mixed> $b
     */
    private function members(Request $r, PamUser $actor, array $safe, array $p, array $b): Response
    {
        $method = $r->getMethod();
        $this->permit($actor, $safe, 'GET' === $method ? 'viewSafeMembers' : 'manageSafeMembers');
        $rows = array_values(array_filter($this->store->all('memberships'), fn (array $m): bool => $m['safeName'] === $safe['safeName']));
        if ('GET' === $method && [] === $p) {
            return $this->listing($r, $rows);
        }
        $member = null;
        if ([] !== $p) {
            foreach ($rows as $row) {
                if (0 === strcasecmp($row['memberName'], $p[0])) {
                    $member = $row;
                }
            }
            if (null === $member) {
                throw new PamException(404, 'PAMMOCK404', 'Safe member not found.');
            }
            if ('GET' === $method) {
                return new JsonResponse($member);
            }
            if ('DELETE' === $method) {
                $this->store->delete('memberships', (string) $member['id']);

                return new JsonResponse(null, 204);
            }
        } else {
            $name = $this->required($b, 'memberName');
            $type = $b['memberType'] ?? $b['MemberType'] ?? 'User';
            if (!in_array($type, ['User', 'Group'], true)) {
                $this->bad('memberType must be User or Group.');
            }
            $principal = $this->store->get('Group' === $type ? 'groups' : 'users', $name);
            $name = $principal['username'] ?? $principal['groupName'];
            foreach ($rows as $row) {
                if (0 === strcasecmp($row['memberName'], $name)) {
                    throw new PamException(409, 'PAMMOCK409', 'Already a safe member.');
                }
            }
            $member = ['id' => bin2hex(random_bytes(8)), 'safeName' => $safe['safeName'], 'memberId' => $principal['id'], 'memberName' => $name, 'memberType' => $type, 'membershipExpirationDate' => null];
        }
        if (!isset($b['permissions']) || !is_array($b['permissions']) || array_is_list($b['permissions'])) {
            $this->bad('permissions must be an object.');
        }
        if (array_diff(array_keys($b['permissions']), self::PERMISSIONS)) {
            $this->bad('Unknown safe permission.');
        }
        $this->booleans($b['permissions'], self::PERMISSIONS);
        $member['permissions'] = array_replace(array_fill_keys(self::PERMISSIONS, false), $b['permissions']);
        if (array_key_exists('membershipExpirationDate', $b)) {
            if (null !== $b['membershipExpirationDate'] && (!is_int($b['membershipExpirationDate']) || $b['membershipExpirationDate'] < 0)) {
                $this->bad('Expiration must be a Unix timestamp or null.');
            }
            $member['membershipExpirationDate'] = $b['membershipExpirationDate'];
        }
        $this->store->save('memberships', $member);

        return new JsonResponse($member, [] === $p ? 201 : 200);
    }

    /**
     * @param array<string, mixed> $account
     *
     * @return array<string, mixed>
     */
    private function accountView(array $account): array
    {
        foreach (array_keys($account) as $key) {
            if (str_starts_with($key, '_')) {
                unset($account[$key]);
            }
        }
        unset($account['secret']);
        if ([] === ($account['platformAccountProperties'] ?? null)) {
            $account['platformAccountProperties'] = (object) [];
        }

        return $account;
    }

    /**
     * @param list<string>         $p
     * @param array<string, mixed> $b
     */
    private function accounts(Request $r, PamUser $actor, array $p, array $b): Response
    {
        $method = $r->getMethod();
        if ([] === $p) {
            if ('GET' === $method) {
                $rows = array_filter($this->store->all('accounts'), fn (array $a): bool => $this->allowed($actor, $this->store->get('safes', $a['safeName']), 'listAccounts'));

                return $this->listing($r, array_values(array_map($this->accountView(...), $rows)));
            }
            $safe = $this->store->get('safes', $this->required($b, 'safeName'));
            $this->permit($actor, $safe, 'addAccounts');
            $platform = $this->store->get('platforms', $this->required($b, 'platformId'));
            if (!$platform['active']) {
                $this->bad('Platform is inactive.');
            }
            $username = $this->required($b, 'userName');
            $address = $this->required($b, 'address');
            if (isset($b['secretType']) && 'password' !== $b['secretType']) {
                $this->bad('Only password accounts are supported.');
            }
            $a = ['id' => '99_'.bin2hex(random_bytes(6)), 'name' => $b['name'] ?? $address.'-'.$username, 'address' => $address, 'userName' => $username, 'platformId' => $platform['platformID'], 'safeName' => $safe['safeName'], 'secretType' => 'password', 'remoteMachinesAccess' => $b['remoteMachinesAccess'] ?? ['remoteMachines' => '', 'accessRestrictedToRemoteMachines' => false], 'platformAccountProperties' => $b['platformAccountProperties'] ?? [], 'secretManagement' => $b['secretManagement'] ?? ['automaticManagementEnabled' => true], 'createdTime' => time(), 'modifiedTime' => time(), '_secret' => $this->required($b, 'secret'), '_versions' => [], '_activities' => [], '_lockedBy' => null];
            $this->validateAccount($a);
            $this->store->save('accounts', $a);

            return new JsonResponse($this->accountView($a), 201);
        }
        $a = $this->store->get('accounts', $p[0]);
        $safe = $this->store->get('safes', $a['safeName']);
        $action = strtolower(implode('/', array_slice($p, 1)));
        if ('' !== $action) {
            return $this->accountAction($r, $actor, $a, $safe, $action, $b);
        }
        $this->permit($actor, $safe, match ($method) {
            'DELETE' => 'deleteAccounts', 'PATCH' => 'updateAccountProperties', default => 'listAccounts',
        });
        if ('DELETE' === $method) {
            $this->store->delete('accounts', $a['id']);

            return new JsonResponse(null, 204);
        }
        if ('GET' === $method) {
            return new JsonResponse($this->accountView($a));
        }
        if (!array_is_list($b) || [] === $b) {
            $this->bad('JSON Patch array required.');
        }
        foreach ($b as $patch) {
            if (!is_array($patch) || !in_array($patch['op'] ?? '', ['add', 'replace', 'remove'], true) || !is_string($patch['path'] ?? null)) {
                $this->bad('Invalid JSON Patch operation.');
            }
            $path = explode('/', ltrim($patch['path'], '/'));
            if (!in_array($path[0], ['name', 'address', 'userName', 'platformAccountProperties', 'secretManagement'], true) || count($path) > 2 || (2 === count($path) && !in_array($path[0], ['platformAccountProperties', 'secretManagement'], true))) {
                $this->bad('Account property is immutable or unsupported.');
            }
            if ('name' === $path[0]) {
                $this->permit($actor, $safe, 'renameAccounts');
            }
            $ref = &$a;
            foreach (array_slice($path, 0, -1) as $segment) {
                $ref = &$ref[$segment];
            }
            if (!is_array($ref)) {
                $this->bad('Patch parent must be an object.');
            }
            $key = end($path);
            if ('add' !== $patch['op'] && !array_key_exists($key, $ref)) {
                $this->bad('Patch target does not exist.');
            }
            if ('remove' === $patch['op']) {
                unset($ref[$key]);
            } else {
                if (!array_key_exists('value', $patch)) {
                    $this->bad('Patch value is required.');
                } $ref[$key] = $patch['value'];
            }
            unset($ref);
        }
        $this->validateAccount($a);
        $a['modifiedTime'] = time();
        $this->store->save('accounts', $a);

        return new JsonResponse($this->accountView($a));
    }

    /**
     * @param array<string, mixed> $a
     */
    private function validateAccount(array $a): void
    {
        foreach (['name', 'address', 'userName'] as $key) {
            $this->required($a, $key);
        }
        if (!is_array($a['platformAccountProperties'] ?? null) || !is_array($a['secretManagement'] ?? null)) {
            $this->bad('Account properties and secretManagement must be objects.');
        }
        $this->booleans($a['secretManagement'], ['automaticManagementEnabled']);
        foreach ($a['platformAccountProperties'] as $value) {
            if (!is_scalar($value)) {
                $this->bad('Platform account properties must contain scalar values.');
            }
        }
    }

    /**
     * @param array<string, mixed> $a
     * @param array<string, mixed> $safe
     * @param array<string, mixed> $b
     */
    private function accountAction(Request $r, PamUser $actor, array $a, array $safe, string $action, array $b): Response
    {
        if (($b['ChangeEntireGroup'] ?? false) || ($b['ChangeImmediately'] ?? false)) {
            $this->bad('Group-wide and immediate-next-password workflows are not supported.');
        }
        $permission = match ($action) {
            'password/retrieve', 'secret/retrieve', 'secret/versions' => 'retrieveAccounts',
            'password/update' => 'updateAccountContent',
            'setnextpassword' => 'specifyNextAccountContent',
            'activities' => 'viewAuditLog', 'unlock', 'checkin' => 'unlockAccounts',
            'psmconnect' => 'useAccounts',
            default => 'initiateCPMAccountManagementOperations',
        };
        $this->permit($actor, $safe, $permission);
        if ('activities' === $action) {
            return $this->listing($r, $a['_activities']);
        }
        if ('secret/versions' === $action) {
            return new JsonResponse(['Versions' => array_map(static fn (array $v): array => ['versionID' => $v['versionID'], 'modificationDate' => $v['modificationDate'], 'modifiedBy' => $v['modifiedBy']], $a['_versions'])]);
        }
        if ('psmconnect' === $action) {
            $platform = $this->store->get('platforms', $a['platformId']);
            $connector = $this->required($b, 'ConnectionComponent');
            if (!$platform['active']) {
                $this->bad('Platform is inactive.');
            }
            $enabled = false;
            foreach ($platform['psm']['PSMConnectors'] as $component) {
                if ($component['PSMConnectorID'] === $connector && $component['Enabled']) {
                    $enabled = true;
                }
            }
            if (!$enabled) {
                $this->bad('Connector is not enabled on this platform.');
            }
            $server = $this->store->get('servers', $platform['psm']['PSMServerId']);
            if ('PSMP' === $server['Type']) {
                $this->bad('PSMP uses an SSH client; this endpoint generates an RDP file for PSM servers only.');
            }
            $port = '3389';
            foreach ($platform['psm']['PSMConnectors'] as $component) {
                if ($component['PSMConnectorID'] !== $connector) {
                    continue;
                }
                foreach ($platform['_overrideUserParameters'][$connector] ?? [] as $parameter) {
                    if ('Port' === $parameter['Name']) {
                        $port = $parameter['Value'];
                    }
                }
            }

            return new Response('full address:s:'.$server['Address']."\r\nusername:s:".$actor->username."\r\nalternate shell:s:psm /u ".$a['userName'].' /a '.$a['address'].' /c '.$connector.' /p '.$port."\r\n", 200, ['Content-Type' => 'application/rdp', 'Content-Disposition' => 'attachment; filename="mock-session.rdp"', 'X-PAM-Mock' => 'No remote session is opened']);
        }
        if (in_array($action, ['password/retrieve', 'secret/retrieve'], true)) {
            $secret = $a['_secret'];
            if (isset($b['Version'])) {
                $secret = null;
                foreach ($a['_versions'] as $version) {
                    if ((string) $version['versionID'] === (string) $b['Version']) {
                        $secret = $version['secret'];
                    }
                }
                if (null === $secret) {
                    throw new PamException(404, 'PAMMOCK404', 'Secret version not found.');
                }
            }
            $response = new JsonResponse($secret);
        } else {
            if ('setnextpassword' === $action) {
                $a['_nextSecret'] = $this->required($b, 'NewCredentials');
            }
            if (in_array($action, ['password/update', 'change', 'reconcile'], true)) {
                $a['_versions'][] = ['versionID' => count($a['_versions']) + 1, 'modificationDate' => time(), 'modifiedBy' => $actor->username, 'secret' => $a['_secret']];
                $a['_secret'] = 'password/update' === $action ? $this->required($b, 'NewCredentials') : ($a['_nextSecret'] ?? 'Mock!'.bin2hex(random_bytes(12)));
                unset($a['_nextSecret']);
                $a['secretManagement']['lastModifiedTime'] = time();
            }
            if ('verify' === $action) {
                $a['secretManagement']['lastVerifiedTime'] = time();
            }
            if ('resume' === $action) {
                $a['secretManagement']['automaticManagementEnabled'] = true;
            }
            if ('cancel' === $action) {
                unset($a['_nextSecret']);
            }
            if (in_array($action, ['unlock', 'checkin'], true)) {
                $a['_lockedBy'] = null;
            }
            $response = 'secret/generate' === $action ? new JsonResponse('Mock!'.bin2hex(random_bytes(12))) : new JsonResponse(null, 204);
        }
        $a['_activities'][] = ['id' => count($a['_activities']) + 1, 'activity' => $action, 'user' => $actor->username, 'date' => time()];
        $a['modifiedTime'] = time();
        $this->store->save('accounts', $a);

        return $response;
    }

    /**
     * @param array<string, mixed> $platform
     *
     * @return array<string, mixed>
     */
    private function platformView(array $platform): array
    {
        return ['ID' => $platform['ID'], 'PlatformID' => $platform['platformID'], 'Name' => $platform['name'], 'Active' => $platform['active'], 'SystemType' => $platform['systemType'], 'AllowedSafes' => '.*'];
    }

    /**
     * @param list<string>         $p
     * @param array<string, mixed> $b
     */
    private function platforms(Request $r, PamUser $actor, string $kind, array $p, array $b): Response
    {
        $this->requireAdmin($actor);
        if ('psm' === $kind) {
            $rows = $this->store->all('servers' === strtolower($p[0]) ? 'servers' : 'connectors');
            $isServers = 'servers' === strtolower($p[0]);
            $rows = array_map(static fn (array $row): array => $isServers
                ? ['Id' => $row['id'], 'Name' => $row['Name'], 'Address' => $row['Address']]
                : ['Id' => $row['id'], 'DisplayName' => $row['DisplayName']], $rows);

            return new JsonResponse($isServers ? ['PSMServers' => $rows] : ['PSMConnectors' => $rows, 'Total' => count($rows)]);
        }
        if ([] === $p) {
            return new JsonResponse(['Platforms' => array_map(static fn (array $platform): array => ['general' => ['id' => $platform['platformID'], 'name' => $platform['name'], 'systemType' => $platform['systemType'], 'active' => $platform['active'], 'description' => '', 'platformBaseID' => $platform['platformID'], 'platformType' => 'targets' === $platform['category'] ? 'regular' : 'group']], $this->store->all('platforms'))]);
        }
        $category = strtolower($p[0]);
        if (in_array($category, ['targets', 'dependents', 'groups', 'rotationalgroups'], true)) {
            if (1 === count($p)) {
                return $this->listing($r, array_values(array_map($this->platformView(...), array_filter($this->store->all('platforms'), fn (array $v): bool => $v['category'] === $category))), 'Platforms', 'Total');
            }
            if ('systemtypes' === strtolower($p[1])) {
                return new JsonResponse(['SystemTypes' => ['Windows', 'Unix', 'Database', 'Network', 'Application']]);
            }
            array_shift($p);
        } else {
            $category = null;
        }
        $platform = $this->store->get('platforms', $p[0]);
        if (null !== $category && $platform['category'] !== $category) {
            throw new PamException(404, 'PAMMOCK404', 'Platform does not belong to this category.');
        }
        $action = strtolower($p[1] ?? '');
        $method = $r->getMethod();
        if ('privilegedsessionmanagement' === $action) {
            if ('GET' === $method) {
                return new JsonResponse($platform['psm']);
            }
            $serverId = $b['PSMServerId'] ?? $b['PSMServerID'] ?? null;
            if (!is_string($serverId)) {
                $this->bad('PSMServerId is required.');
            }
            $server = $this->store->get('servers', $serverId);
            if (!isset($b['PSMConnectors']) || !is_array($b['PSMConnectors']) || !array_is_list($b['PSMConnectors'])) {
                $this->bad('PSMConnectors must be an array.');
            }
            $seen = [];
            foreach ($b['PSMConnectors'] as $connector) {
                if (!is_array($connector)) {
                    $this->bad('Invalid connector.');
                }
                $id = $this->required($connector, 'PSMConnectorID');
                $component = $this->store->get('connectors', $id);
                $this->booleans($connector, ['Enabled']);
                if (!array_key_exists('Enabled', $connector) || isset($seen[$id]) || !in_array($server['Type'], $component['_protocols'], true)) {
                    $this->bad('Duplicate, incomplete or incompatible connector/server association.');
                }
                $seen[$id] = true;
                if (array_diff(array_keys($connector), ['PSMConnectorID', 'Enabled'])) {
                    $this->bad('Connector policy accepts only PSMConnectorID and Enabled.');
                }
            }
            $platform['psm'] = ['PSMServerId' => $server['id'], 'PSMConnectors' => $b['PSMConnectors']];
            $this->store->save('platforms', $platform);

            return new JsonResponse($platform['psm']);
        }
        if ('settings' === $action) {
            if ('PATCH' === $method) {
                $this->bad('Platform settings patch is not supported yet.');
            }

            return new JsonResponse(['ID' => $platform['ID'], 'PlatformID' => $platform['platformID'], 'PrivilegedSessionManagement' => $platform['psm'], 'Properties' => ['Required' => [['Name' => 'Address'], ['Name' => 'UserName']], 'Optional' => [['Name' => 'Port'], ['Name' => 'LogonDomain']]]]);
        }
        if ('safes' === $action) {
            $names = [];
            foreach ($this->store->all('accounts') as $a) {
                if ($a['platformId'] === $platform['platformID']) {
                    $names[] = $a['safeName'];
                }
            }

            return $this->listing($r, array_values(array_filter($this->store->all('safes'), fn (array $s): bool => in_array($s['safeName'], $names, true))));
        }
        if ('generatesecret' === $action) {
            return new JsonResponse('Mock!'.bin2hex(random_bytes(12)));
        }
        if ('DELETE' === $method) {
            foreach ($this->store->all('accounts') as $a) {
                if ($a['platformId'] === $platform['platformID']) {
                    throw new PamException(409, 'PAMMOCK409', 'Platform is used by accounts.');
                }
            }
            $this->store->delete('platforms', $platform['id']);

            return new JsonResponse(null, 204);
        }
        if ('duplicate' === $action) {
            $name = $this->required($b, 'Name');
            $this->store->unique('platforms', 'platformID', $name);
            $platform['id'] = $name;
            $platform['platformID'] = $name;
            $platform['name'] = $name;
            $platform['ID'] = max(array_column($this->store->all('platforms'), 'ID')) + 1;
        } elseif (in_array($action, ['activate', 'deactivate'], true)) {
            $platform['active'] = 'activate' === $action;
        } elseif ('PUT' === $method) {
            $platform['name'] = $this->required($b, 'Name');
        } elseif ('GET' === $method) {
            return new JsonResponse(['PlatformID' => $platform['platformID'], 'Properties' => (object) ['PolicyID' => $platform['platformID']], 'Active' => $platform['active']]);
        }
        $this->store->save('platforms', $platform);

        return new JsonResponse($this->platformView($platform), 'duplicate' === $action ? 201 : 200);
    }
}
