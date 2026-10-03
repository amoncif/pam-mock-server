<?php

namespace App\Pam\Authentication;

use App\Pam\Authentication\Entity\PamSession;
use App\Pam\Authentication\Entity\PamUser;
use App\Shared\Api\PamException;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class AuthenticationService
{
    public function __construct(private readonly EntityManagerInterface $em, private readonly int $tokenTtl)
    {
    }

    /** @param array<string, mixed> $endpoint */
    public function handle(Request $request, array $endpoint): Response
    {
        if ($endpoint['logout']) {
            $session = $this->validate($request);
            $this->em->remove($session);
            $this->em->flush();

            return $endpoint['legacy'] ? new Response('', 200, ['Cache-Control' => 'no-store']) : new JsonResponse(new \stdClass(), headers: ['Cache-Control' => 'no-store']);
        }
        $data = $endpoint['shared'] ? [] : $this->payload($request, $endpoint['saml']);
        $provider = $endpoint['provider'] ?? ($endpoint['shared'] ? 'Shared' : 'SAML');
        if ($endpoint['legacy'] && $this->boolean($data, 'useRadiusAuthentication')) {
            $provider = 'RADIUS';
        }
        $concurrent = $this->boolean($data, 'concurrentSession');
        $connection = $data['connectionNumber'] ?? null;
        if (null !== $connection && (!is_int($connection) || $connection < 0 || $connection > 100)) {
            throw new PamException(400, 'PASWS013E', 'connectionNumber must be an integer from 0 to 100.');
        }
        $username = $endpoint['shared'] ? 'appuser' : ($endpoint['saml'] ? $this->samlUser($data) : $this->requiredString($data, 'username'));
        $password = ($endpoint['shared'] || $endpoint['saml']) ? null : $this->requiredString($data, 'password');
        $newPassword = array_key_exists('newPassword', $data) ? $this->requiredString($data, 'newPassword') : null;
        if (null !== $newPassword && !in_array($provider, ['CyberArk', 'LDAP'], true)) {
            throw new PamException(400, 'PASWS013E', 'newPassword is supported only for CyberArk and LDAP.');
        }
        $user = $this->em->find(PamUser::class, $username);
        // Password verification also runs for unknown users to reduce timing differences.
        $valid = null === $password || password_verify($password, $user->passwordHash ?? '$2y$10$123456789012345678901u.y4oLnbFUchACGOVEluPVHw79q0CaUfW');
        if (null === $user || !$valid || ('Shared' !== $provider && $user->provider !== $provider)) {
            throw new PamException(403, 'ITATS004E', 'Authentication failed.');
        }
        if ('disabled' === $user->state) {
            throw new PamException(403, 'ITATS006E', 'The local user is disabled.');
        }
        if ('locked' === $user->state) {
            throw new PamException(403, 'ITATS005E', 'The local user is locked.');
        }
        if ('expired' === $user->state && null === $newPassword) {
            throw new PamException(403, 'ITATS009E', 'The local password has expired.');
        }
        $token = base64_encode(random_bytes(48));
        $this->em->wrapInTransaction(function () use ($user, $provider, $newPassword, $token, $concurrent, $connection, $endpoint): void {
            // Serializes login for the same user, including the concurrent session cap.
            $this->em->lock($user, LockMode::PESSIMISTIC_WRITE);
            $sessions = $this->em->getRepository(PamSession::class)->findBy(['user' => $user]);
            $active = 0;
            foreach ($sessions as $existing) {
                if ($existing->expiresAt <= time() || (!$concurrent && (!$endpoint['legacy'] || $existing->connectionNumber === $connection))) {
                    $this->em->remove($existing);
                } else {
                    ++$active;
                }
            }
            if ($active >= 300) {
                throw new PamException(409, 'PAMMOCK409', 'The local limit of 300 concurrent sessions was reached.');
            }
            if (null !== $newPassword) {
                $user->passwordHash = password_hash($newPassword, PASSWORD_ARGON2ID);
                $user->state = 'active';
            }
            $this->em->persist(new PamSession($token, $user, $provider, time(), $this->tokenTtl, $connection));
        });
        $result = $endpoint['shared'] ? ['LogonResult' => $token] : ($endpoint['legacy'] ? ['CyberArkLogonResult' => $token] : $token);

        return new JsonResponse($result, headers: ['Cache-Control' => 'no-store', 'Pragma' => 'no-cache']);
    }

    public function validate(Request $request): PamSession
    {
        $token = $request->headers->get('Authorization', '');
        $session = '' === $token ? null : $this->em->find(PamSession::class, hash('sha256', $token));
        if (null === $session || $session->expiresAt <= time() || 'active' !== $session->user->state) {
            throw new PamException(401, 'PASWS006E', 'The session token is missing, invalid, or expired.');
        }
        $session->lastActivity = time();
        $this->em->flush();

        return $session;
    }

    /** @return array<string, mixed> */
    private function payload(Request $request, bool $saml): array
    {
        $expected = $saml ? 'application/x-www-form-urlencoded' : 'application/json';
        if (strtolower(trim(explode(';', $request->headers->get('Content-Type', ''))[0])) !== $expected) {
            throw new PamException(415, 'PAMMOCK415', 'Expected Content-Type: '.$expected.'.');
        }
        if ($saml) {
            return $request->request->all();
        }
        try {
            $decoded = json_decode($request->getContent(), false, 32, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            throw new PamException(400, 'PASWS013E', 'A valid JSON object is required.');
        }
        if (!$decoded instanceof \stdClass) {
            throw new PamException(400, 'PASWS013E', 'A JSON object is required.');
        }

        return (array) $decoded;
    }

    /** @param array<string, mixed> $data */
    private function requiredString(array $data, string $field): string
    {
        if (!isset($data[$field]) || !is_string($data[$field]) || '' === $data[$field]) {
            throw new PamException(400, 'PASWS013E', $field.' is required and must be a non-empty string.');
        }

        return $data[$field];
    }

    /** @param array<string, mixed> $data */
    private function boolean(array $data, string $field): bool
    {
        $value = $data[$field] ?? false;
        if (is_bool($value)) {
            return $value;
        }
        if (is_string($value) && in_array(strtolower($value), ['true', 'false'], true)) {
            return 'true' === strtolower($value);
        }
        throw new PamException(400, 'PASWS013E', $field.' must be a boolean.');
    }

    /** @param array<string, mixed> $data */
    private function samlUser(array $data): string
    {
        if (!$this->boolean($data, 'apiUse')) {
            throw new PamException(400, 'PASWS013E', 'apiUse must be true.');
        }
        $assertion = $this->requiredString($data, 'SAMLResponse');
        // Exact local fixture assertion only. Never accept arbitrary or real IdP assertions.
        $fixture = base64_encode('<MockSAMLResponse user="saml.user" issuer="pam-mock-local"/>');
        if (!hash_equals($fixture, $assertion)) {
            throw new PamException(403, 'ITATS004E', 'The local SAML assertion is invalid.');
        }

        return 'saml.user';
    }
}
