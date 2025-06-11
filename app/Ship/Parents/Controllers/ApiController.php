<?php

declare(strict_types=1);

namespace App\Ship\Parents\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Base API Controller
 *
 * All Container API controllers should extend this base controller
 */
abstract class ApiController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;

    /**
     * Return a successful response
     *
     * @param  mixed  $data
     */
    protected function success($data = [], string $message = 'Success', int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Return a created response
     *
     * @param  mixed  $data
     */
    protected function created($data = [], string $message = 'Resource created successfully'): JsonResponse
    {
        return $this->success($data, $message, 201);
    }

    /**
     * Return an error response
     *
     * @param  mixed  $errors
     */
    protected function error(string $message = 'Error', int $statusCode = 400, $errors = []): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    /**
     * Return a not found response
     */
    protected function notFound(string $message = 'Resource not found'): JsonResponse
    {
        return $this->error($message, 404);
    }
}
