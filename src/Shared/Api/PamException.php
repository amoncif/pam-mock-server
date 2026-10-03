<?php

namespace App\Shared\Api;

final class PamException extends \RuntimeException
{
    public function __construct(public readonly int $status, public readonly string $errorCode, string $message)
    {
        parent::__construct($message);
    }
}
