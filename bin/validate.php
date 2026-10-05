#!/usr/bin/env php
<?php

require dirname(__DIR__).'/vendor/autoload.php';
use App\Shared\Api\EndpointManifest;
use Opis\JsonSchema\CompliantValidator as Validator;
use Opis\JsonSchema\Errors\ErrorFormatter;

$root = dirname(__DIR__);
$manifest = (new EndpointManifest($root))->all();
$errors = [];
$ids = [];
$routes = [];
$count = 0;
$publishedCount = 0;
$document = json_decode(file_get_contents($root.'/api/openapi.json'), false, 512, JSON_THROW_ON_ERROR);
$schema = json_decode(file_get_contents($root.'/api/schema/openapi-3.1.json'), false, 512, JSON_THROW_ON_ERROR);
// Resolve the OAS schema's local meta anchor explicitly for Opis compatibility.
$resolveAnchor = function (mixed $node) use (&$resolveAnchor): mixed {
    if ($node instanceof stdClass) {
        if (isset($node->{'$dynamicRef'}) && '#meta' === $node->{'$dynamicRef'}) {
            unset($node->{'$dynamicRef'});
            $node->{'$ref'} = '#/$defs/schema';
        }
        foreach ($node as $name => $value) {
            $node->$name = $resolveAnchor($value);
        }
    } elseif (is_array($node)) {
        $node = array_map($resolveAnchor, $node);
    }

    return $node;
};
$result = (new Validator())->validate($document, $resolveAnchor($schema));
if (!$result->isValid()) {
    $errors[] = json_encode((new ErrorFormatter())->format($result->error()), JSON_PRETTY_PRINT);
}
// The official OAS document schema leaves Schema Objects open. Compile each
// request/response schema too, so invalid schema keywords fail this check.
$schemaValidator = new Validator();
$checkSchemas = function (mixed $node, string $path = '') use (&$checkSchemas, &$errors, $schemaValidator): void {
    if (!is_object($node) && !is_array($node)) {
        return;
    }
    foreach ($node as $name => $child) {
        if ('schema' === $name && $child instanceof stdClass) {
            try {
                $schemaValidator->loader()->loadObjectSchema($child, draft: '2020-12');
            } catch (Throwable $error) {
                $errors[] = $path.': '.$error->getMessage();
            }
        } else {
            $checkSchemas($child, $path.'/'.$name);
        }
    }
};
$checkSchemas($document);
$spec = json_decode(json_encode($document), true);
foreach ($manifest as $endpoint) {
    foreach (['id', 'domain', 'name', 'method', 'path', 'authentication', 'parameters', 'responses', 'source', 'source_version', 'status', 'tests', 'confidence'] as $field) {
        if (!array_key_exists($field, $endpoint)) {
            $errors[] = 'Missing '.$field;
        }
    }
    $id = $endpoint['id'];
    if (isset($ids[$id])) {
        $errors[] = 'Duplicate ID: '.$id;
    } $ids[$id] = true;
    $key = $endpoint['method'].' '.preg_replace('/\{[^}]+\}/', '{}', strtolower($endpoint['path']));
    if (isset($routes[$key])) {
        $errors[] = 'Duplicate route: '.$key;
    } $routes[$key] = true;
    if (!filter_var($endpoint['source']['url'] ?? '', FILTER_VALIDATE_URL)) {
        $errors[] = 'Missing source: '.$id;
    }
    if (!in_array($endpoint['status'], ['documented', 'stub', 'partial', 'implemented', 'tested'], true)) {
        $errors[] = 'Invalid status: '.$id;
    }
    if (!preg_match('~^/PasswordVault/(API|WebServices|api)/~', $endpoint['path']) || str_contains($endpoint['path'], 'https:')) {
        $errors[] = 'Invalid PVWA path: '.$id;
    }
    preg_match_all('/\{([^}]+)\}/', $endpoint['path'], $matches);
    $declared = array_column(array_filter($endpoint['parameters'], fn (array $p): bool => 'path' === $p['in']), 'name');
    sort($declared);
    $expected = $matches[1];
    sort($expected);
    if ($declared !== $expected) {
        $errors[] = 'Path parameters disagree: '.$id;
    }
    if (in_array($endpoint['status'], ['implemented', 'tested'], true)) {
        if ([] === $endpoint['tests']) {
            $errors[] = 'Implemented endpoint without compatibility test: '.$id;
        }
        foreach ($endpoint['tests'] as $test) {
            if (!str_starts_with($test, 'tests/Compatibility/') || !is_file($root.'/'.$test) || !str_contains(file_get_contents($root.'/'.$test), $id)) {
                $errors[] = 'Missing linked compatibility contract: '.$id;
            }
        }
    }
    $operation = $spec['paths'][$endpoint['path']][strtolower($endpoint['method'])] ?? [];
    if (in_array($endpoint['status'], ['implemented', 'tested', 'partial'], true)) {
        ++$publishedCount;
        if (($operation['operationId'] ?? '') !== $id || ($operation['x-mock-status'] ?? '') !== $endpoint['status']) {
            $errors[] = 'OpenAPI and manifest disagree: '.$id;
        }
    } elseif ([] !== $operation) {
        $errors[] = 'Non-operational endpoint exposed in Swagger: '.$id;
    }
    ++$count;
}
$operations = 0;
foreach ($spec['paths'] as $item) {
    foreach (array_keys($item) as $method) {
        if (in_array($method, ['get', 'post', 'put', 'patch', 'delete', 'head', 'options'], true)) {
            ++$operations;
        }
    }
}
if ($operations !== $publishedCount) {
    $errors[] = 'OpenAPI operation count differs from the operational manifest subset.';
}
if ([] !== $errors) {
    fwrite(STDERR, implode("\n", $errors)."\n");
    exit(1);
}
echo "Validated $count inventoried operations, $publishedCount operational OpenAPI operations, test links and schema.\n";
