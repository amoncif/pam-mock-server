<?php

namespace App\Shared\Api;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

final class ManifestRouteLoader extends Loader
{
    public function __construct(private readonly EndpointManifest $manifest, private readonly string $projectDir)
    {
        parent::__construct();
    }

    public function load(mixed $resource, ?string $type = null): RouteCollection
    {
        $routes = new RouteCollection();
        $routes->addResource(new FileResource($this->projectDir.'/api/pam-endpoints.yaml'));
        $endpoints = $this->manifest->all();
        // Static paths must win over placeholders (for example Users/Secret versus Users/{id}).
        usort($endpoints, static fn (array $a, array $b): int => substr_count($a['path'], '{') <=> substr_count($b['path'], '{'));
        foreach ($endpoints as $e) {
            $route = new Route($e['path'], ['_controller' => ManifestController::class, 'endpointId' => $e['id']], methods: [$e['method']]);
            $routes->add('pam.'.$e['id'], $route);
        }

        return $routes;
    }

    public function supports(mixed $resource, ?string $type = null): bool
    {
        return 'pam_manifest' === $type;
    }
}
