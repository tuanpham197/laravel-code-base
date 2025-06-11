<?php

declare(strict_types=1);

namespace App\Ship\Parents\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Base Request Class
 *
 * All Container requests should extend this base request
 */
abstract class Request extends FormRequest
{
    // Common request functionality can be added here
}
