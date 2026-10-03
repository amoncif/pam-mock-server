<?php

namespace App\Shared\Api;

use App\Pam\Authentication\AuthenticationService;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class LocalController
{
    #[Route('/', methods: ['GET'])]
    public function index(): RedirectResponse
    {
        return new RedirectResponse('/api/docs');
    }

    #[Route('/health', methods: ['GET'])]
    public function health(Connection $db): JsonResponse
    {
        $db->executeQuery('SELECT 1');

        return new JsonResponse(['status' => 'ok']);
    }

    #[Route('/mock/session', methods: ['GET'])]
    public function session(Request $request, AuthenticationService $auth): JsonResponse
    {
        try {
            $session = $auth->validate($request);
        } catch (PamException $e) {
            return new JsonResponse(['ErrorCode' => $e->errorCode, 'ErrorMessage' => $e->getMessage()], $e->status);
        }

        return new JsonResponse(['username' => $session->user->username, 'provider' => $session->provider, 'expiresAt' => $session->expiresAt], headers: ['Cache-Control' => 'no-store']);
    }
}
