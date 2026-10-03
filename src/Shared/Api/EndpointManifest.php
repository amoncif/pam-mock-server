<?php

namespace App\Shared\Api;

use Symfony\Component\Yaml\Yaml;

final class EndpointManifest
{
    /** @var list<array<string, mixed>>|null */
    private ?array $endpoints = null;

    public function __construct(private readonly string $projectDir)
    {
    }

    /** @return list<array<string, mixed>> */
    public function all(): array
    {
        if (null !== $this->endpoints) {
            return $this->endpoints;
        }
        $contents = file_get_contents($this->projectDir.'/api/pam-endpoints.yaml');

        return $this->endpoints = json_decode($contents, true) ?? Yaml::parse($contents);
    }

    /** @return array<string, mixed> */
    public function get(string $id): array
    {
        foreach ($this->all() as $endpoint) {
            if ($endpoint['id'] === $id) {
                return $endpoint;
            }
        }
        throw new \LogicException('Unknown manifest operation: '.$id);
    }
}
