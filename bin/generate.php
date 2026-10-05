#!/usr/bin/env php
<?php

require dirname(__DIR__).'/vendor/autoload.php';
use App\Shared\Api\EndpointManifest;

$root = dirname(__DIR__);
$manifest = (new EndpointManifest($root))->all();
$openapi = json_decode(file_get_contents($root.'/api/openapi.json'), true, 512, JSON_THROW_ON_ERROR);
function writeArtifact(string $name, string $content): void
{
    global $root;
    @mkdir(dirname($root.'/'.$name), 0775, true);
    if (str_ends_with($name, '.md')) {
        $content = preg_replace('/[ \t]+$/m', '', $content);
    }
    file_put_contents($root.'/'.$name, $content);
}
function encode(mixed $data): string
{
    return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR)."\n";
}
$groups = [];
$inventory = "# API inventory\n\nGenerated from `api/pam-endpoints.yaml`. Run `make generate` after changing the manifest and exporting OpenAPI.\n\nThis is the union of reviewed public PVWA references. It is not certified as exhaustive for PAM 15.2. Each entry records evidence and uncertainty. Authentication-provider configuration APIs remain stubs. Separate PTA-host, cloud-only and VRM-host services are excluded.\n\n";
foreach ($manifest as $e) {
    $groups[$e['tag']] ??= ['total' => 0, 'implemented' => 0, 'partial' => 0];
    ++$groups[$e['tag']]['total'];
    if (isset($groups[$e['tag']][$e['status']])) {
        ++$groups[$e['tag']][$e['status']];
    }
    $fields = $e['request_schema']['properties'] ?? [];
    $inventory .= '## '.$e['id']."\n\n`".$e['method'].' '.$e['path'].'` — **'.$e['status']."**\n\n";
    $inventory .= '- Category: '.$e['tag']."\n- Operation: ".$e['name']."\n- Authentication: ".$e['authentication']."\n- Request media type: ".($e['request_content_type'] ?? 'No body recorded')."\n";
    $inventory .= '- Request fields: '.([] === $fields ? (null === $e['request_schema'] ? 'None recorded; see confidence note.' : 'Open schema; not fully verified.') : implode(', ', array_map(fn ($k, $v) => '`'.$k.'` ('.($v['type'] ?? 'unknown').')', array_keys($fields), $fields)))."\n";
    $inventory .= '- Parameters: '.implode(', ', array_map(fn ($p) => $p['in'].' `'.$p['name'].'`', $e['parameters']))."\n- Response contracts: ";
    foreach ($e['responses'] as $status => $response) {
        $inventory .= $status.' '.($response['schema']['type'] ?? 'unspecified').'; ';
    }
    $inventory .= "\n- Known errors: ".implode(', ', $e['known_errors'])."\n- Source: [".$e['source']['type'].']('.$e['source']['url'].")\n- Source version: ".$e['source_version']."\n- Confidence: ".$e['confidence']."\n\n".$e['notes']."\n\n";
}
writeArtifact('docs/api-inventory.md', $inventory);
$coverage = "# API coverage\n\nCoverage measures runtime implementation of the known manifest. It does not measure completeness of the vendor API or prove behavior against a live Vault.\n\n| Category | Implemented | Partial | Known |\n|---|---:|---:|---:|\n";
foreach ($groups as $tag => $counts) {
    $coverage .= '| '.$tag.' | '.$counts['implemented'].' | '.$counts['partial'].' | '.$counts['total']." |\n";
}
$done = array_sum(array_column($groups, 'implemented'));
$total = count($manifest);
$coverage .= "\n$done / $total operations implemented (".sprintf('%.2f', 100 * $done / $total).'%). '.($total - $done)." stubbed. Run `php bin/console pam:api:coverage` for current counts.\n";
writeArtifact('docs/api-coverage.md', $coverage);
$env = ['baseUrl' => 'http://localhost:8080', 'username' => 'pamadmin', 'password' => 'PamAdmin123!', 'token' => '', 'ldapUsername' => 'john.ldap', 'ldapPassword' => 'LdapUser123!', 'windowsUsername' => 'windows.user', 'windowsPassword' => 'WindowsUser123!', 'radiusUsername' => 'radius.user', 'radiusPassword' => 'RadiusUser123!', 'samlResponse' => base64_encode('<MockSAMLResponse user="saml.user" issuer="pam-mock-local"/>')];
$requests = [];
$byId = array_column($manifest, null, 'id');
foreach (['auth.cyberark.logon', 'auth.ldap.logon', 'auth.windows.logon', 'auth.radius.logon', 'auth.legacy.logon', 'auth.saml.logon', 'auth.shared.logon'] as $id) {
    $e = $byId[$id];
    $operation = $openapi['paths'][$e['path']]['post'];
    $body = null;
    $mode = null;
    if (!$e['shared']) {
        if ($e['saml']) {
            $mode = 'urlencoded';
            $body = ['SAMLResponse' => '{{samlResponse}}', 'apiUse' => 'true', 'concurrentSession' => 'true'];
        } else {
            $prefix = in_array($e['provider'], ['LDAP', 'Windows', 'RADIUS'], true) ? strtolower($e['provider']) : '';
            $body = ['username' => '{{'.('' === $prefix ? 'username' : $prefix.'Username').'}}', 'password' => '{{'.('' === $prefix ? 'password' : $prefix.'Password').'}}'];
            if (!$e['legacy']) {
                $body['concurrentSession'] = true;
            } $mode = 'raw';
        }
    }
    $requests[] = ['name' => $e['name'].($e['legacy'] ? ' legacy' : ''), 'method' => 'POST', 'path' => $e['path'], 'body' => $body, 'mode' => $mode, 'status' => 200, 'capture' => true, 'auth' => false];
    $requests[] = ['name' => 'Reuse token after '.$id, 'method' => 'GET', 'path' => '/mock/session', 'status' => 200, 'capture' => false, 'auth' => true, 'body' => null, 'mode' => null];
    $logout = $byId[$e['shared'] ? 'auth.shared.logoff' : ($e['saml'] ? 'auth.saml.logoff' : ($e['legacy'] ? 'auth.legacy.logoff' : 'auth.logoff'))];
    $requests[] = ['name' => 'Logoff after '.$id, 'method' => 'POST', 'path' => $logout['path'], 'status' => 200, 'capture' => false, 'auth' => true, 'body' => null, 'mode' => null];
}
$requests[] = ['name' => 'Invalid credentials', 'method' => 'POST', 'path' => $byId['auth.cyberark.logon']['path'], 'body' => ['username' => '{{username}}', 'password' => 'deliberately-invalid'], 'mode' => 'raw', 'status' => 403, 'capture' => false, 'auth' => false];
$coreLogin = $requests[0];
$coreLogin['folder'] = 'Core modules';
$coreLogin['name'] = 'Core logon';
$requests[] = $coreLogin;
$cases = json_decode(file_get_contents($root.'/tests/Compatibility/core-cases.json'), true, 512, JSON_THROW_ON_ERROR);
foreach ($manifest as $operation) {
    if ('core' !== ($operation['handler'] ?? '') || 'GET' !== $operation['method']) {
        continue;
    }
    foreach ($cases as $case) {
        if ($case['id'] !== $operation['id']) {
            continue;
        }
        $requests[] = ['folder' => 'Core modules', 'name' => $operation['name'], 'method' => 'GET', 'path' => '/PasswordVault/API/'.$case['path'], 'status' => 200, 'capture' => false, 'auth' => true, 'body' => null, 'mode' => null];
    }
}
$requests[] = ['folder' => 'Core modules', 'name' => 'Core logoff', 'method' => 'POST', 'path' => '/PasswordVault/API/Auth/Logoff', 'status' => 200, 'capture' => false, 'auth' => true, 'body' => null, 'mode' => null];
$postman = [];
foreach ($requests as $i => $q) {
    $header = [];
    if ($q['auth']) {
        $header[] = ['key' => 'Authorization', 'value' => '{{token}}'];
    }
    $request = ['method' => $q['method'], 'url' => '{{baseUrl}}'.$q['path'], 'header' => $header];
    if ('raw' === $q['mode']) {
        $header[] = ['key' => 'Content-Type', 'value' => 'application/json'];
        $request['body'] = ['mode' => 'raw', 'raw' => encode($q['body']), 'options' => ['raw' => ['language' => 'json']]];
    }
    if ('urlencoded' === $q['mode']) {
        $header[] = ['key' => 'Content-Type', 'value' => 'application/x-www-form-urlencoded'];
        $request['body'] = ['mode' => 'urlencoded', 'urlencoded' => array_map(fn ($key, $value) => ['key' => $key, 'value' => $value], array_keys($q['body']), $q['body'])];
    }
    $request['header'] = $header;
    $script = ['pm.test("Expected HTTP status", () => pm.response.to.have.status('.$q['status'].'));'];
    if ($q['capture']) {
        $script[] = 'if (pm.response.code === 200) { const body = pm.response.json(); pm.environment.set("token", typeof body === "string" ? body : (body.CyberArkLogonResult || body.LogonResult)); }';
    }
    $postman[$q['folder'] ?? 'Authentication'][] = ['name' => $q['name'], 'request' => $request, 'event' => [['listen' => 'test', 'script' => ['type' => 'text/javascript', 'exec' => $script]]]];
    $bru = "meta {\n  name: ".$q['name']."\n  type: http\n  seq: ".($i + 1)."\n}\n\n".strtolower($q['method'])." {\n  url: {{baseUrl}}".$q['path']."\n  body: ".('raw' === $q['mode'] ? 'json' : ('urlencoded' === $q['mode'] ? 'formUrlEncoded' : 'none'))."\n  auth: none\n}\n";
    if ([] !== $header) {
        $bru .= "\nheaders {\n";
        foreach ($header as $h) {
            $bru .= '  '.$h['key'].': '.$h['value']."\n";
        } $bru .= "}\n";
    }
    if ('raw' === $q['mode']) {
        $bru .= "\nbody:json {\n".preg_replace('/^/m', '  ', trim(encode($q['body'])))."\n}\n";
    }
    if ('urlencoded' === $q['mode']) {
        $bru .= "\nbody:form-urlencoded {\n";
        foreach ($q['body'] as $k => $v) {
            $bru .= "  $k: $v\n";
        } $bru .= "}\n";
    }
    if ($q['capture']) {
        $bru .= "\nscript:post-response {\n  if (res.getStatus() === 200) {\n    const body = res.getBody();\n    bru.setEnvVar(\"token\", typeof body === \"string\" ? body : (body.CyberArkLogonResult || body.LogonResult));\n  }\n}\n";
    }
    $bru .= "\ntests {\n  test(\"Expected HTTP status\", function () { expect(res.getStatus()).to.equal(".$q['status']."); });\n}\n";
    writeArtifact('clients/bruno/'.($q['folder'] ?? 'Authentication').'/'.sprintf('%02d', $i + 1).'-'.preg_replace('/[^a-z0-9]+/i', '-', $q['name']).'.bru', $bru);
}
$folders = [];
foreach ($postman as $folder => $items) {
    $folders[] = ['name' => $folder, 'item' => $items];
    writeArtifact('clients/bruno/'.$folder.'/folder.bru', "meta {\n  name: $folder\n  seq: ".count($folders)."\n}\n");
}
writeArtifact('clients/postman/pam-mock-smoke.postman_collection.json', encode(['info' => ['name' => 'PAM Mock Server', 'schema' => 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json', 'description' => 'Independent local mock. Generated from the project contract; not copied from a vendor collection.'], 'item' => $folders]));
writeArtifact('clients/postman/local.postman_environment.json', encode(['name' => 'PAM Mock local', 'values' => array_map(fn ($key, $value) => ['key' => $key, 'value' => $value, 'enabled' => true, 'type' => 'default'], array_keys($env), $env)]));
writeArtifact('clients/bruno/bruno.json', encode(['version' => '1', 'name' => 'PAM Mock Server', 'type' => 'collection', 'ignore' => ['node_modules', '.git']]));
$bruEnv = "vars {\n";
foreach ($env as $key => $value) {
    $bruEnv .= "  $key: $value\n";
} $bruEnv .= "}\n";
writeArtifact('clients/bruno/environments/local.bru', $bruEnv);
echo "Generated inventory, coverage, and client collections from $total operations.\n";

require __DIR__.'/generate-postman.php';
