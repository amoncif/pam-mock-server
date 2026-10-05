<?php

namespace App\Tests\Compatibility;

use PHPUnit\Framework\TestCase;

final class PostmanReferenceTest extends TestCase
{
    private function leaves(array $items, string $prefix = ''): array
    {
        $result = [];
        foreach ($items as $item) {
            $name = preg_replace('/^(✅ |⏳ |📝 )/u', '', $item['name']);
            $path = $prefix.'/'.$name;
            if (isset($item['item'])) {
                $result += $this->leaves($item['item'], $path);
            } else {
                $result[$path] = $item;
            }
        }

        return $result;
    }

    public function testReferenceStructureAndPayloadsArePreservedExceptSourcedCorrections(): void
    {
        $root = dirname(__DIR__, 2);
        $source = json_decode(file_get_contents($root.'/api/reference/cyberark-pam.postman_collection.json'), true);
        $output = json_decode(file_get_contents($root.'/clients/postman/pam-mock.postman_collection.json'), true);
        $changes = json_decode(file_get_contents($root.'/api/reference/postman-corrections.json'), true);
        $original = $this->leaves($source['item']);
        $generated = $this->leaves($output['item']);
        self::assertCount(181, $generated);
        self::assertSame(array_keys($original), array_keys($generated));
        foreach ($original as $path => $item) {
            $actual = $generated[$path]['request'];
            self::assertSame($item['request']['method'], $actual['method'], $path);
            if ('Get Users' === $item['name']) {
                self::assertStringContainsString('filter=userType eq EPVUser', $actual['url']['raw']);
            } else {
                self::assertSame($item['request']['url'], $actual['url'], $path);
            }
            if (isset($changes[$item['name']]['body'])) {
                self::assertStringStartsWith('https://docs.cyberark.com/', $changes[$item['name']]['source']);
                self::assertSame($changes[$item['name']]['body'], json_decode($actual['body']['raw'], true));
            } else {
                self::assertSame($item['request']['body'] ?? null, $actual['body'] ?? null, 'Unreviewed request payload changed: '.$path);
            }
        }
        $names = array_column($generated, 'name');
        self::assertContains('✅ Add Account', $names);
        self::assertContains('✅ Update Session Management Policy of Platform', $names);
        self::assertContains('📝 Connect Using PSM', $names);
        self::assertContains('⏳ Ad-Hoc Connect through PSM', $names);
        $policy = $changes['Update Session Management Policy of Platform']['body'];
        self::assertSame(['PSMServerId', 'PSMServerName', 'PSMConnectors'], array_keys($policy));
        self::assertSame(['PSMConnectorID', 'Enabled'], array_keys($policy['PSMConnectors'][0]));
    }

    public function testFixtureNamingAndPrivateOverridesStayOutOfPublicPolicy(): void
    {
        $data = json_decode(file_get_contents(dirname(__DIR__, 2).'/fixtures/acme.json'), true);
        foreach ($data['safes'] as $safe) {
            self::assertMatchesRegularExpression('/^PAM-(PRD|UAT)-[A-Z-]+$/', $safe['safeName']);
        }
        foreach ($data['groups'] as $group) {
            self::assertMatchesRegularExpression('/^GG_PAM_[A-Z_]+$/', $group['groupName']);
        }
        foreach ($data['accounts'] as $account) {
            self::assertStringStartsWith('ACME-', $account['platformId']);
            self::assertStringEndsWith('.corp.acme.example', $account['address']);
            self::assertStringContainsString($account['userName'], $account['name']);
        }
        foreach ($data['platforms'] as $platform) {
            foreach ($platform['psm']['PSMConnectors'] as $connector) {
                self::assertSame(['PSMConnectorID', 'Enabled'], array_keys($connector));
            }
        }
    }
}
