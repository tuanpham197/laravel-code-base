<?php

declare(strict_types=1);

namespace App\Ship\Exceptions;

use Exception;

/**
 * Not Found Exception
 *
 * Thrown when a requested resource cannot be found
 */
class NotFoundException extends Exception
{
    public function __construct(string $message = 'The requested resource was not found.', int $code = 404, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
