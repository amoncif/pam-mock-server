<?php

namespace App\Shared\Api;

use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\OpenApi\Model;
use ApiPlatform\OpenApi\OpenApi;

final class ManifestOpenApiFactory implements OpenApiFactoryInterface
{
    public function __construct(private readonly OpenApiFactoryInterface $decorated, private readonly EndpointManifest $manifest)
    {
    }

    public function __invoke(array $context = []): OpenApi
    {
        $api = ($this->decorated)($context);
        $api->getComponents()->getSecuritySchemes()['PamToken'] = new \ArrayObject(['type' => 'apiKey', 'in' => 'header', 'name' => 'Authorization', 'description' => 'Raw token returned by Logon.']);
        $paths = new Model\Paths();
        foreach ($this->manifest->all() as $e) {
            $params = [];
            foreach ($e['parameters'] as $p) {
                $params[] = new Model\Parameter(name: $p['name'], in: $p['in'], required: $p['required'], schema: $p['schema']);
            }
            $body = null === $e['request_schema'] ? null : new Model\RequestBody(content: new \ArrayObject([$e['request_content_type'] => ['schema' => $e['request_schema']]]), required: !empty($e['request_schema']['required']));
            $responses = [];
            foreach ($e['responses'] as $status => $response) {
                $responses[(string) $status] = new Model\Response(description: $response['description'], content: isset($response['schema']) ? new \ArrayObject(['application/json' => ['schema' => $response['schema']]]) : null);
            }
            $operation = new Model\Operation(operationId: $e['id'], tags: [$e['tag']], summary: strtoupper($e['status']).' — '.$e['name'], description: $e['notes'], parameters: $params, requestBody: $body, responses: $responses, security: 'none' === $e['authentication'] ? [] : [['PamToken' => []]], extensionProperties: ['x-mock-status' => $e['status'], 'x-source' => $e['source'], 'x-contract-confidence' => $e['confidence']]);
            $item = $paths->getPath($e['path']) ?? new Model\PathItem();
            $method = 'with'.ucfirst(strtolower($e['method']));
            $paths->addPath($e['path'], $item->$method($operation));
        }

        return $api->withOpenapi('3.1.0')->withPaths($paths)->withServers([new Model\Server('/')]);
    }
}
