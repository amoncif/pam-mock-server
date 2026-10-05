<?php

// Included by generate.php. Vendor-shaped requests come from the pinned reference,
// never from a guessed schema. Explicit corrections carry an official source URL.
$reference = json_decode(file_get_contents($root.'/api/reference/cyberark-pam.postman_collection.json'), true, 512, JSON_THROW_ON_ERROR);
$changes = json_decode(file_get_contents($root.'/api/reference/postman-corrections.json'), true, 512, JSON_THROW_ON_ERROR);
$normal = static function (string $path): string {
    $path = preg_replace('~^\{\{[^}]+\}\}~', '', explode('?', $path)[0]);
    $path = preg_replace('~\{\{[^}]+\}\}|\{[^}]+\}|:[^/]+~', '{}', $path);

    return strtolower(rtrim($path, '/'));
};
$index = [];
foreach ($manifest as $endpoint) {
    $index[$endpoint['method'].' '.$normal($endpoint['path'])] = $endpoint;
}
$decorate = function (array $items) use (&$decorate, $index, $normal, $changes): array {
    foreach ($items as &$item) {
        if (isset($item['item'])) {
            $item['item'] = $decorate($item['item']);
            continue;
        }
        $originalName = $item['name'];
        $request = &$item['request'];
        $key = $request['method'].' '.$normal($request['url']['raw']);
        $endpoint = $index[$key] ?? null;
        // One upstream provider placeholder represents four credential routes.
        if ('POST /passwordvault/api/auth/{}/logon' === $key) {
            $endpoint = $index['POST /passwordvault/api/auth/cyberark/logon'] ?? null;
        }
        $working = null !== $endpoint && 'stub' !== $endpoint['status'];
        $description = 'Mock: '.($working ? 'available (see documented compatibility limits).' : 'not implemented.')."\n\n";
        if (isset($changes[$originalName])) {
            $change = $changes[$originalName];
            if (isset($change['body'])) {
                $request['body'] = ['mode' => 'raw', 'raw' => encode($change['body']), 'options' => ['raw' => ['language' => 'json']]];
            }
            foreach ($change['query_values'] ?? [] as $queryKey => $queryValue) {
                foreach ($request['url']['query'] ?? [] as $i => $query) {
                    if ($query['key'] !== $queryKey) {
                        continue;
                    }
                    $request['url']['raw'] = str_replace($queryKey.'='.$query['value'], $queryKey.'='.$queryValue, $request['url']['raw']);
                    $request['url']['query'][$i]['value'] = $queryValue;
                }
            }
            $description .= 'Official payload reference: '.$change['source']."\n".$change['reason']."\n\n";
        } else {
            $description .= "Request body preserved from the pinned public v13.2 collection. Current official parity is not certified.\n\n";
        }
        $item['name'] = ($working ? '✅ ' : '⏳ ').$originalName;
        $request['description'] = $description.($request['description'] ?? '');
        if (isset($request['body']['raw']) && '' !== $request['body']['raw']) {
            json_decode($request['body']['raw']);
            if (JSON_ERROR_NONE !== json_last_error()) {
                $item['name'] = '📝 '.$originalName;
                $request['description'] = "Template requires editing before sending (upstream placeholders are not valid JSON).\n\n".$request['description'];
            }
        }
        unset($request);
    }

    return $items;
};
$reference['info']['name'] = 'PAM Mock — CyberArk reference';
$reference['info']['description'] = 'Pinned public CyberArk PAM v13.2 folder structure. ✅ route available in the mock (partial compatibility); ⏳ unimplemented; 📝 template requires input. Officially reviewed payload corrections are linked per request. This is an independent local simulator, not an official CyberArk collection. Do not run the complete reference as a smoke suite: it includes destructive operations and unimplemented APIs.';
$reference['item'] = $decorate($reference['item']);
writeArtifact('clients/postman/pam-mock.postman_collection.json', encode($reference));
$fixture = json_decode(file_get_contents($root.'/fixtures/acme.json'), true, 512, JSON_THROW_ON_ERROR);
$values = ['pasBaseURL' => 'http://localhost:8080', 'pasAPIUsername' => 'pamadmin', 'pasAPIPassword' => 'PamAdmin123!', 'pasSessionToken' => '', 'pasAuthType' => 'CyberArk', 'pasAccountID' => '1_1', 'pasSafe' => $fixture['safes'][0]['safeName'], 'pasSafeMember' => $fixture['groups'][1]['groupName'], 'pasUsername' => $fixture['accounts'][0]['userName'], 'pasAddress' => $fixture['accounts'][0]['address'], 'pasObjectName' => $fixture['accounts'][0]['name'], 'pasPlatformName' => $fixture['platforms'][0]['platformID'], 'pasPlatformID' => '1', 'pasPSMServerID' => $fixture['servers'][0]['id'], 'pasPSMServerName' => $fixture['servers'][0]['Name'], 'pasConnectionComponent' => 'PSM-RDP', 'pasGroupID' => '2', 'pasGroupName' => $fixture['groups'][1]['groupName'], 'pasUserID' => '4', 'pasUserName' => 'auditor', 'pasFolder' => 'Root', 'pasKeywords' => '', 'ptaBaseURL' => 'http://localhost:8080'];
writeArtifact('clients/postman/cyberark-local.postman_environment.json', encode(['name' => 'CyberArk reference — local mock', 'values' => array_map(static fn (string $key, string $value): array => ['key' => $key, 'value' => $value, 'enabled' => true, 'type' => 'default'], array_keys($values), $values), '_postman_variable_scope' => 'environment']));
