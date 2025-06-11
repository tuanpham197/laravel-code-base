<?php

declare(strict_types=1);

namespace App\Ship\Exceptions;

use Exception;

/**
 * Create Resource Failed Exception
 *
 * Thrown when a resource creation operation fails
 */
class CreateResourceFailedException extends Exception
{
    public function __construct(string $message = 'Failed to create the requested resource.', int $code = 404, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
