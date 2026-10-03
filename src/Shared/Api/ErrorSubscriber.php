<?php

namespace App\Shared\Api;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

#[AsEventListener(event: 'kernel.exception', priority: 100)]
final class ErrorSubscriber
{
    public function __invoke(ExceptionEvent $event): void
    {
        if (!str_starts_with(strtolower($event->getRequest()->getPathInfo()), '/passwordvault/')) {
            return;
        }
        $e = $event->getThrowable();
        $status = $e instanceof PamException ? $e->status : ($e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500);
        $code = $e instanceof PamException ? $e->errorCode : 'PAMMOCK'.$status;
        $message = $e instanceof PamException ? $e->getMessage() : (500 === $status ? 'The mock server could not process the request.' : 'No matching operation for this request.');
        $headers = $e instanceof HttpExceptionInterface ? $e->getHeaders() : [];
        $event->setResponse(new JsonResponse(['ErrorCode' => $code, 'ErrorMessage' => $message], $status, $headers + ['Cache-Control' => 'no-store']));
    }
}
