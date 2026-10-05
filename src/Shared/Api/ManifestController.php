<?php

namespace App\Shared\Api;

use App\Pam\Authentication\AuthenticationService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final class ManifestController
{
    public function __construct(private readonly AuthenticationService $authentication, private readonly EndpointManifest $manifest, private readonly \App\Pam\Core\CoreService $core)
    {
    }

    public function __invoke(Request $request, string $endpointId): Response
    {
        $endpoint = $this->manifest->get($endpointId);
        if ('authentication' === $endpoint['domain'] && 'stub' !== $endpoint['status']) {
            return $this->authentication->handle($request, $endpoint);
        }
        if ('none' !== $endpoint['authentication']) {
            $session = $this->authentication->validate($request);
            if (isset($endpoint['handler']) && 'core' === $endpoint['handler']) {
                return $this->core->handle($request, $session->user);
            }
        }
        throw new PamException(501, 'PAMMOCK001', 'This CyberArk-compatible endpoint is documented but not implemented yet.');
    }
}
