<?php

namespace App\Exceptions;

use RuntimeException;

class EmailJsException extends RuntimeException
{
    protected array $context;

    public function __construct(string $message, array $context = [], int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->context = $context;
    }

    public function context(): array
    {
        return $this->context;
    }
}
