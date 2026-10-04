<?php

namespace App\Tests\Compatibility;

use App\Shared\Fixtures\LabFixtures;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CoreModulesTest extends WebTestCase
{
    private KernelBrowser $client;
    private string $token;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->client->disableReboot();
        $em = self::getContainer()->get(EntityManagerInterface::class);
        $em->getConnection()->executeStatement('TRUNCATE pam_session, pam_user, lab_object CASCADE');
        self::getContainer()->get(LabFixtures::class)->load($em);
        $this->token = $this->login('pamadmin', 'PamAdmin123!');
    }

    private function login(string $user, string $password): string
    {
        $this->client->jsonRequest('POST', '/PasswordVault/API/auth/CyberArk/Logon', ['username' => $user, 'password' => $password]);
        self::assertResponseIsSuccessful();

        return json_decode($this->client->getResponse()->getContent(), true);
    }

    private function call(string $method, string $path, mixed $body = null, int $status = 200, ?string $token = null): mixed
    {
        $this->client->request($method, '/PasswordVault/API/'.$path, server: ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => $token ?? $this->token], content: null === $body ? '' : json_encode([] === $body && 'PATCH' !== $method ? (object) [] : $body, JSON_THROW_ON_ERROR));
        self::assertResponseStatusCodeSame($status, $method.' '.$path.' '.$this->client->getResponse()->getContent());
        self::assertStringContainsString('no-store', $this->client->getResponse()->headers->get('Cache-Control'));
        $content = $this->client->getResponse()->getContent();
        if (str_contains($this->client->getResponse()->headers->get('Content-Type', ''), 'application/json')) {
            return json_decode($content, true);
        }

        return $content;
    }

    public static function operations(): iterable
    {
        $rows = json_decode(file_get_contents(__DIR__.'/core-cases.json'), true, 512, JSON_THROW_ON_ERROR);
        foreach ($rows as $row) {
            yield $row['id'] => [$row['method'], $row['path'], $row['body'], $row['status']];
        }
    }

    #[DataProvider('operations')]
    public function testEveryEnabledOperation(string $method, string $path, mixed $body, int $status): void
    {
        $result = $this->call($method, $path, $body, $status);
        if (200 === $status || 201 === $status) {
            self::assertNotNull($result);
        }
        $this->call($method, $path, $body, 401, 'invalid');
    }

    public function testCreateUserGroupSafeAndAccountThenRevokeInheritedAccess(): void
    {
        $u = $this->call('POST', 'Users', ['username' => 'scenario.user', 'initialPassword' => 'LocalScenario123!'], 201);
        $g = $this->call('POST', 'UserGroups', ['groupName' => 'Scenario Operators'], 201);
        $this->call('POST', 'UserGroups/'.$g['id'].'/Members', ['memberId' => (string) $u['id'], 'memberType' => 'vault'], 201);
        $safe = $this->call('POST', 'Safes', ['safeName' => 'SCENARIO', 'numberOfVersionsRetention' => 5], 201);
        $this->call('POST', 'Safes/SCENARIO/Members', ['memberName' => $g['groupName'], 'MemberType' => 'Group', 'permissions' => ['listAccounts' => true, 'retrieveAccounts' => true]], 201);
        $a = $this->call('POST', 'Accounts', ['name' => 'Scenario', 'userName' => 'svc.test', 'address' => 'test.acme.example', 'safeName' => 'SCENARIO', 'platformId' => 'MockWinDomain', 'secret' => 'FictionalSecret123!'], 201);
        self::assertArrayNotHasKey('_secret', $a);
        self::assertArrayNotHasKey('secret', $a);
        $token = $this->login('scenario.user', 'LocalScenario123!');
        self::assertSame(1, $this->call('GET', 'Accounts', null, 200, $token)['count']);
        self::assertSame('FictionalSecret123!', $this->call('POST', 'Accounts/'.$a['id'].'/Password/Retrieve', [], 200, $token));
        $this->call('DELETE', 'Accounts/'.$a['id'], null, 403, $token);
        $this->call('PUT', 'UserGroups/'.$g['id'], ['groupName' => 'Renamed Operators']);
        $this->call('PUT', 'Safes/SCENARIO', ['safeName' => 'RENAMED']);
        self::assertSame('RENAMED', $this->call('GET', 'Accounts/'.$a['id'], null, 200, $token)['safeName']);
        $this->call('DELETE', 'UserGroups/'.$g['id'].'/Members/scenario.user', null, 204);
        self::assertSame(0, $this->call('GET', 'Accounts', null, 200, $token)['count']);
        $this->call('POST', 'Accounts/'.$a['id'].'/Password/Retrieve', [], 403, $token);
        $this->call('DELETE', 'Accounts/'.$a['id'], null, 204);
        $this->call('DELETE', 'Safes/'.$safe['id'], null, 204);
        $this->call('DELETE', 'UserGroups/'.$g['id'], null, 204);
        $this->call('DELETE', 'Users/'.$u['id'], null, 204);
        $this->call('GET', 'currentuser', null, 401, $token);
    }

    public function testPasswordResetAndDisableInvalidateSessions(): void
    {
        $token = $this->login('auditor', 'Audit123!');
        $this->call('POST', 'Users/4/ResetPassword', ['newPassword' => 'ChangedMock123!'], 204);
        $this->call('GET', 'currentuser', null, 401, $token);
        $token = $this->login('auditor', 'ChangedMock123!');
        $this->call('POST', 'Users/4/disable', null, 204);
        $this->call('GET', 'currentuser', null, 401, $token);
        $this->call('POST', 'Users/4/enable', null, 204);
        $this->login('auditor', 'ChangedMock123!');
    }

    public function testPutDisableRevokesTokensAndPasswordsAllowSeparators(): void
    {
        $password = 'Mock/Password'.chr(92).'123!';
        $user = $this->call('POST', 'Users', ['username' => 'separator.user', 'initialPassword' => $password], 201);
        $token = $this->login('separator.user', $password);
        $this->call('PUT', 'Users/'.$user['id'], ['enableUser' => false]);
        $this->call('PUT', 'Users/'.$user['id'], ['enableUser' => true]);
        $this->call('GET', 'currentuser', null, 401, $token);
        $this->login('separator.user', $password);
    }

    public function testAuditAccessDoesNotExposeSecretsAndSearchCannotProbeSecrets(): void
    {
        $token = $this->login('auditor', 'Audit123!');
        $accounts = $this->call('GET', 'Accounts', null, 200, $token);
        self::assertSame(40, $accounts['count']);
        self::assertStringNotContainsString('ACME-Mock-Only', json_encode($accounts));
        self::assertSame(0, $this->call('GET', 'Accounts?search=ACME-Mock-Only', null, 200, $token)['count']);
        $this->call('POST', 'Accounts/1_1/Password/Retrieve', null, 403, $token);
        $this->call('GET', 'Users', null, 403, $token);
        $this->call('GET', 'Platforms', null, 403, $token);
    }

    public function testAtomicPatchSecretHistoryAndReferentialIntegrity(): void
    {
        $before = $this->call('GET', 'Accounts/1_1');
        $this->call('PATCH', 'Accounts/1_1', [['op' => 'replace', 'path' => '/name', 'value' => 'temporary'], ['op' => 'replace', 'path' => '/safeName', 'value' => 'missing']], 400);
        self::assertSame($before, $this->call('GET', 'Accounts/1_1'));
        $this->call('POST', 'Accounts/1_1/Password/Update', ['NewCredentials' => 'ChangedMockSecret!'], 204);
        self::assertSame('ChangedMockSecret!', $this->call('POST', 'Accounts/1_1/Password/Retrieve'));
        self::assertSame('ACME-Mock-Only-001!', $this->call('POST', 'Accounts/1_1/Password/Retrieve', ['Version' => 1]));
        self::assertStringNotContainsString('ACME-Mock-Only', json_encode($this->call('GET', 'Accounts/1_1/Secret/Versions')));
        $this->call('DELETE', 'Safes/APP-PROD-WINDOWS', null, 409);
        $this->call('DELETE', 'Platforms/targets/1', null, 409);
        $this->call('POST', 'Safes', ['safeName' => 'app-prod-windows'], 409);
        $this->call('POST', 'Users', ['username' => 'PAMADMIN', 'initialPassword' => 'MockOnly!'], 409);
        $this->call('POST', 'Users/1/disable', null, 409);
    }

    public function testPlatformPolicyOverrideRoundtripAndValidation(): void
    {
        $path = 'Platforms/Targets/1/PrivilegedSessionManagement';
        $policy = ['PSMServerId' => 'PSM-LAB-02', 'PSMConnectors' => [['PSMConnectorID' => 'PSM-RDP', 'Enabled' => true, 'OverrideUserParameters' => [['Name' => 'Port', 'Value' => '3390', 'Visible' => false]]]]];
        self::assertSame($policy, $this->call('PUT', $path, $policy));
        self::assertSame($policy, $this->call('GET', $path));
        $rdp = $this->call('POST', 'Accounts/1_1/PSMConnect', ['ConnectionComponent' => 'PSM-RDP']);
        self::assertStringContainsString('psm-02.acme.example', $rdp);
        self::assertStringContainsString('/p 3390', $rdp);
        self::assertStringNotContainsString('ACME-Mock-Only', $rdp);
        $invalid = $policy;
        $invalid['PSMServerId'] = 'PSMP-LAB-01';
        $this->call('PUT', $path, $invalid, 400);
        self::assertSame($policy, $this->call('GET', $path));
        $invalid['PSMServerId'] = 'missing';
        $this->call('PUT', $path, $invalid, 404);
        $invalid = $policy;
        $invalid['PSMConnectors'][0]['Enabled'] = 'true';
        $this->call('PUT', $path, $invalid, 400);
        $policy['PSMConnectors'][0]['Enabled'] = false;
        $this->call('PUT', $path, $policy);
        $this->call('POST', 'Accounts/1_1/PSMConnect', ['ConnectionComponent' => 'PSM-RDP'], 400);
        $duplicate = $this->call('POST', 'Platforms/targets/1/duplicate', ['Name' => 'NewMockPlatform'], 201);
        $this->call('POST', 'Platforms/targets/'.$duplicate['ID'].'/deactivate');
        self::assertFalse($this->call('GET', 'Platforms/NewMockPlatform')['Active']);
        $this->call('DELETE', 'Platforms/targets/'.$duplicate['ID'], null, 204);
        $this->call('GET', 'Platforms/NewMockPlatform', null, 404);
    }

    public function testPaginationFilteringAndFixtureRelationships(): void
    {
        $users = $this->call('GET', 'Users?search=pamadmin');
        self::assertSame(1, $users['Total']);
        self::assertSame('pamadmin', $users['Users'][0]['username']);
        $accounts = $this->call('GET', 'Accounts?filter=safeName%20eq%20APP-PROD-WINDOWS&limit=2&offset=1');
        self::assertCount(2, $accounts['value']);
        self::assertSame(8, $accounts['count']);
        $this->call('GET', 'Accounts?limit=-1', null, 400);
        $data = json_decode(file_get_contents(dirname(__DIR__, 2).'/fixtures/acme.json'), true);
        foreach ($data['accounts'] as $account) {
            self::assertContains($account['safeName'], array_column($data['safes'], 'safeName'));
            self::assertContains($account['platformId'], array_column($data['platforms'], 'platformID'));
        }
        foreach ($data['platforms'] as $platform) {
            self::assertContains($platform['psm']['PSMServerId'], array_column($data['servers'], 'id'));
            foreach ($platform['psm']['PSMConnectors'] as $connector) {
                self::assertContains($connector['PSMConnectorID'], array_column($data['connectors'], 'id'));
            }
        }
    }
}
