<?php

namespace App\Shared\Api;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

/** Match IIS-style case and trailing slashes without a POST redirect. */
#[AsEventListener(event: 'kernel.request', priority: 40)]
final class CompatibilityRoutingSubscriber
{
    public function __construct(private readonly EndpointManifest $manifest)
    {
    }

    public function __invoke(RequestEvent $event): void
    {
        $request = $event->getRequest();
        if (!str_starts_with(strtolower($request->getPathInfo()), '/passwordvault/')) {
            return;
        }
        $path = rtrim($request->getPathInfo(), '/');
        $endpoints = $this->manifest->all();
        usort($endpoints, static fn (array $a, array $b): int => substr_count($a['path'], '{') <=> substr_count($b['path'], '{'));
        $allowed = [];
        foreach ($endpoints as $e) {
            $pattern = preg_replace('/\\\{[^}]+\\\}/', '([^/]+)', preg_quote($e['path'], '~'));
            if (!preg_match('~^'.$pattern.'$~iD', $path, $matches)) {
                continue;
            }
            $allowed[] = $e['method'];
            if ($e['method'] !== $request->getMethod()) {
                continue;
            }
            $request->attributes->add(['_controller' => ManifestController::class, '_route' => 'pam.'.$e['id'], 'endpointId' => $e['id']]);
            preg_match_all('/\{([^}]+)\}/', $e['path'], $names);
            foreach ($names[1] as $i => $name) {
                $request->attributes->set($name, rawurldecode($matches[$i + 1]));
            }

            return;
        }
        if ([] !== $allowed) {
            throw new MethodNotAllowedHttpException(array_unique($allowed));
        }
        if (preg_match('~/api/auth/[^/]+/logon$~i', $path)) {
            throw new PamException(400, 'PAMMOCK400', 'Unsupported authentication provider.');
        }
    }
}
