<?php

namespace App\Tests\Compatibility;

use App\Pam\Authentication\Entity\PamSession;
use App\Shared\Fixtures\LabFixtures;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AuthenticationTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->client->disableReboot();
        $em = self::getContainer()->get(EntityManagerInterface::class);
        $em->getConnection()->executeStatement('TRUNCATE pam_session, pam_user, lab_object CASCADE');
        self::getContainer()->get(LabFixtures::class)->load($em);
    }

    public static function providers(): iterable
    {
        yield 'auth.cyberark.logon' => ['CyberArk', 'pamadmin', 'PamAdmin123!'];
        yield 'auth.ldap.logon' => ['LDAP', 'john.ldap', 'LdapUser123!'];
        yield 'auth.windows.logon' => ['Windows', 'windows.user', 'WindowsUser123!'];
        yield 'auth.radius.logon' => ['RADIUS', 'radius.user', 'RadiusUser123!'];
    }

    private function login(string $provider = 'CyberArk', string $username = 'pamadmin', string $password = 'PamAdmin123!', array $extra = []): string
    {
        $this->json('/PasswordVault/API/Auth/'.$provider.'/Logon', ['username' => $username, 'password' => $password] + $extra);
        self::assertResponseIsSuccessful();
        self::assertResponseHeaderSame('content-type', 'application/json');
        $token = json_decode($this->client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);
        self::assertIsString($token);
        self::assertGreaterThanOrEqual(64, strlen($token));

        return $token;
    }

    private function json(string $path, mixed $body, string $method = 'POST', string $token = ''): void
    {
        $this->client->request($method, $path, server: ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => $token], content: json_encode($body, JSON_THROW_ON_ERROR));
    }

    private function error(int $status, ?string $code = null): void
    {
        self::assertResponseStatusCodeSame($status);
        self::assertResponseHeaderSame('content-type', 'application/json');
        $body = json_decode($this->client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);
        self::assertSame(['ErrorCode', 'ErrorMessage'], array_keys($body));
        self::assertIsString($body['ErrorMessage']);
        if (null !== $code) {
            self::assertSame($code, $body['ErrorCode']);
        }
    }

    #[DataProvider('providers')]
    public function testProviderLogonAndTokenReuse(string $provider, string $user, string $password): void
    {
        $token = $this->login($provider, $user, $password);
        $this->client->request('GET', '/mock/session', server: ['HTTP_AUTHORIZATION' => $token]);
        self::assertResponseIsSuccessful();
        self::assertSame($user, json_decode($this->client->getResponse()->getContent(), true)['username']);
        $this->client->request('GET', '/PasswordVault/API/Accounts', server: ['HTTP_AUTHORIZATION' => $token]);
        $this->error(501, 'PAMMOCK001');
        $stored = self::getContainer()->get(EntityManagerInterface::class)->find(PamSession::class, hash('sha256', $token));
        self::assertNotNull($stored);
        self::assertSame($provider, $stored->provider);
        self::assertNotSame($token, $stored->tokenHash);
    }

    #[DataProvider('providers')]
    public function testInvalidCredentialsForEachProvider(string $provider, string $user, string $password): void
    {
        $this->json('/PasswordVault/API/Auth/'.$provider.'/Logon', ['username' => $user, 'password' => 'wrong']);
        $this->error(403, 'ITATS004E');
    }

    public static function invalidBodies(): iterable
    {
        yield 'missing username' => [['password' => 'x']];
        yield 'missing password' => [['username' => 'x']];
        yield 'null username' => [['username' => null, 'password' => 'x']];
        yield 'wrong type' => [['username' => [], 'password' => 'x']];
        yield 'empty password' => [['username' => 'pamadmin', 'password' => '']];
        yield 'array' => [[]];
        yield 'scalar' => ['x'];
        yield 'null' => [null];
        yield 'invalid concurrent flag' => [['username' => 'pamadmin', 'password' => 'PamAdmin123!', 'concurrentSession' => 'sometimes']];
    }

    #[DataProvider('invalidBodies')]
    public function testMalformedOrMissingFields(mixed $body): void
    {
        $this->json('/PasswordVault/API/Auth/CyberArk/Logon', $body);
        $this->error(400, 'PASWS013E');
    }

    public function testMalformedJsonAndContentType(): void
    {
        $this->client->request('POST', '/PasswordVault/API/Auth/CyberArk/Logon', server: ['CONTENT_TYPE' => 'application/json'], content: '{');
        $this->error(400);
        $this->client->request('POST', '/PasswordVault/API/Auth/CyberArk/Logon', server: ['CONTENT_TYPE' => 'text/plain'], content: '{}');
        $this->error(415);
    }

    public function testUnknownProviderAndUnknownRoute(): void
    {
        $this->json('/PasswordVault/API/Auth/Unknown/Logon', []);
        $this->error(400, 'PAMMOCK400');
        $this->client->request('GET', '/PasswordVault/API/NoSuchResource');
        $this->error(404);
        $this->client->request('GET', '/PasswordVault/API/Auth/CyberArk/Logon');
        $this->error(405);
    }

    public function testUnknownUserAndWrongProvider(): void
    {
        $this->json('/PasswordVault/API/Auth/CyberArk/Logon', ['username' => 'unknown', 'password' => 'wrong']);
        $this->error(403);
        $this->json('/PasswordVault/API/Auth/LDAP/Logon', ['username' => 'pamadmin', 'password' => 'PamAdmin123!']);
        $this->error(403);
    }

    public function testDisabledLockedAndExpiredUsers(): void
    {
        foreach ([['readonly', 'ReadOnly123!', 'ITATS006E'], ['helpdesk', 'Helpdesk123!', 'ITATS005E'], ['expired.user', 'Expired123!', 'ITATS009E']] as [$user, $password, $code]) {
            $this->json('/PasswordVault/API/Auth/CyberArk/Logon', ['username' => $user, 'password' => $password]);
            $this->error(403, $code);
        }
    }

    public function testPasswordReplacement(): void
    {
        $this->login('CyberArk', 'expired.user', 'Expired123!', ['newPassword' => 'Replacement123!']);
        $this->json('/PasswordVault/API/Auth/CyberArk/Logon', ['username' => 'expired.user', 'password' => 'Expired123!']);
        $this->error(403);
        $this->login('CyberArk', 'expired.user', 'Replacement123!');
        $this->login('LDAP', 'john.ldap', 'LdapUser123!', ['newPassword' => 'Replacement123!']);
        $this->login('LDAP', 'john.ldap', 'Replacement123!');
        $this->json('/PasswordVault/API/Auth/Windows/Logon', ['username' => 'windows.user', 'password' => 'WindowsUser123!', 'newPassword' => 'x']);
        $this->error(400);
    }

    public function testRawTokenAndExpiration(): void
    {
        $token = $this->login();
        foreach (['', 'invalid', 'Bearer '.$token] as $invalid) {
            $this->json('/PasswordVault/API/Auth/Logoff', [], token: $invalid);
            $this->error(401);
        }
        $em = self::getContainer()->get(EntityManagerInterface::class);
        $em->getConnection()->executeStatement('UPDATE pam_session SET expiresat = ? WHERE tokenhash = ?', [time() - 1, hash('sha256', $token)]);
        $this->json('/PasswordVault/API/Auth/Logoff', [], token: $token);
        $this->error(401);
    }

    public function testLogoffInvalidatesToken(): void
    {
        // auth.logoff
        $token = $this->login();
        $this->json('/PasswordVault/API/Auth/Logoff', [], token: $token);
        self::assertResponseStatusCodeSame(200);
        self::assertSame('{}', $this->client->getResponse()->getContent());
        $this->json('/PasswordVault/API/Auth/Logoff', [], token: $token);
        $this->error(401);
        $this->client->request('GET', '/PasswordVault/API/Accounts', server: ['HTTP_AUTHORIZATION' => $token]);
        $this->error(401);
    }

    public function testConcurrentSessionsAndReplacement(): void
    {
        $first = $this->login();
        $second = $this->login(extra: ['concurrentSession' => true]);
        self::assertNotSame($first, $second);
        foreach ([$first, $second] as $token) {
            $this->client->request('GET', '/mock/session', server: ['HTTP_AUTHORIZATION' => $token]);
            self::assertResponseIsSuccessful();
        }
        $third = $this->login();
        foreach ([$first, $second] as $token) {
            $this->json('/PasswordVault/API/Auth/Logoff', [], token: $token);
            $this->error(401);
        }
        $this->json('/PasswordVault/API/Auth/Logoff', [], token: $third);
        self::assertResponseIsSuccessful();
    }

    public function testCaseAndTrailingSlashCompatibility(): void
    {
        $this->json('/passwordvault/api/auth/cyberark/logon/', ['username' => 'pamadmin', 'password' => 'PamAdmin123!']);
        self::assertResponseStatusCodeSame(200);
        $token = json_decode($this->client->getResponse()->getContent(), true);
        $this->json('/PASSWORDVAULT/API/AUTH/LOGOFF/', [], token: $token);
        self::assertResponseStatusCodeSame(200);
    }

    public function testLegacyLogonAndLogoff(): void
    {
        // auth.legacy.logon auth.legacy.logoff
        $base = '/PasswordVault/WebServices/auth/Cyberark/CyberArkAuthenticationService.svc/';
        $tokens = [];
        foreach ([1, 2] as $number) {
            $this->json($base.'Logon', ['username' => 'pamadmin', 'password' => 'PamAdmin123!', 'connectionNumber' => $number]);
            self::assertResponseIsSuccessful();
            $tokens[] = json_decode($this->client->getResponse()->getContent(), true)['CyberArkLogonResult'];
        }
        foreach ($tokens as $token) {
            $this->json($base.'Logoff', [], token: $token);
            self::assertResponseStatusCodeSame(200);
            self::assertSame('', $this->client->getResponse()->getContent());
        }
        $this->json($base.'Logon', ['username' => 'radius.user', 'password' => 'RadiusUser123!', 'useRadiusAuthentication' => true]);
        self::assertResponseIsSuccessful();
    }

    public function testSharedLogonAndLogoff(): void
    {
        // auth.shared.logon auth.shared.logoff
        $base = '/PasswordVault/WebServices/auth/Shared/RestfulAuthenticationService.svc/';
        $this->client->request('POST', $base.'Logon');
        self::assertResponseIsSuccessful();
        $token = json_decode($this->client->getResponse()->getContent(), true)['LogonResult'];
        self::assertIsString($token);
        $this->json($base.'Logoff', [], token: $token);
        self::assertResponseIsSuccessful();
        self::assertSame('{}', $this->client->getResponse()->getContent());
        $this->json($base.'Logoff', [], token: $token);
        $this->error(401);
    }

    public function testSamlLogonAndLogoff(): void
    {
        // auth.saml.logon auth.saml.logoff
        $data = ['SAMLResponse' => base64_encode('<MockSAMLResponse user="saml.user" issuer="pam-mock-local"/>'), 'apiUse' => 'true', 'concurrentSession' => 'true'];
        $this->client->request('POST', '/PasswordVault/API/auth/SAML/Logon', $data, server: ['CONTENT_TYPE' => 'application/x-www-form-urlencoded']);
        self::assertResponseIsSuccessful();
        $token = json_decode($this->client->getResponse()->getContent(), true);
        self::assertIsString($token);
        $this->json('/PasswordVault/API/auth/SAML/Logoff', [], token: $token);
        self::assertResponseIsSuccessful();
        $data['SAMLResponse'] = 'not-an-assertion';
        $this->client->request('POST', '/PasswordVault/API/auth/SAML/Logon', $data, server: ['CONTENT_TYPE' => 'application/x-www-form-urlencoded']);
        $this->error(403);
        $data['apiUse'] = 'false';
        $this->client->request('POST', '/PasswordVault/API/auth/SAML/Logon', $data, server: ['CONTENT_TYPE' => 'application/x-www-form-urlencoded']);
        $this->error(400);
    }

    public function testDatasetAndResetAreDeterministic(): void
    {
        $db = self::getContainer()->get(EntityManagerInterface::class)->getConnection();
        self::assertSame(13, (int) $db->fetchOne('SELECT COUNT(*) FROM pam_user'));
        foreach (['safes' => 8, 'accounts' => 40, 'platforms' => 8, 'memberships' => 26] as $kind => $count) {
            self::assertSame($count, (int) $db->fetchOne('SELECT COUNT(*) FROM lab_object WHERE kind = ?', [$kind]));
        }
        $before = $db->fetchAllAssociative('SELECT * FROM lab_object ORDER BY id');
        $db->executeStatement('TRUNCATE pam_session, pam_user, lab_object CASCADE');
        self::getContainer()->get(EntityManagerInterface::class)->clear();
        self::getContainer()->get(LabFixtures::class)->load(self::getContainer()->get(EntityManagerInterface::class));
        self::assertSame($before, $db->fetchAllAssociative('SELECT * FROM lab_object ORDER BY id'));
    }

    public function testEveryStubHasProtected501Contract(): void
    {
        $token = $this->login();
        $manifest = self::getContainer()->get(\App\Shared\Api\EndpointManifest::class)->all();
        foreach ($manifest as $e) {
            if ('stub' !== $e['status']) {
                continue;
            }
            $path = preg_replace('/\{[^}]+\}/', 'fixture-id', $e['path']);
            $this->client->request($e['method'], $path, server: ['HTTP_AUTHORIZATION' => $token]);
            self::assertResponseStatusCodeSame(501, $e['id'].' '.$path);
            $this->error(501, 'PAMMOCK001');
        }
    }

    public function testSwaggerHasTheEntireManifest(): void
    {
        $this->client->request('GET', '/api/docs.jsonopenapi');
        self::assertResponseIsSuccessful();
        $doc = json_decode($this->client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $manifest = self::getContainer()->get(\App\Shared\Api\EndpointManifest::class)->all();
        foreach ($manifest as $e) {
            self::assertSame($e['status'], $doc['paths'][$e['path']][strtolower($e['method'])]['x-mock-status']);
        }
        $this->client->request('GET', '/api/docs');
        self::assertResponseIsSuccessful();
    }
}
