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
    /**
     * Determine if the user is authorized to make this request.
     */
    abstract public function authorize(): bool;

    /**
     * Get the validation rules that apply to the request.
     */
    abstract public function rules(): array;

    // Common request functionality can be added here
    // protected function failedValidation(Validator $validator): void
    // {
    //     throw new HttpResponseException(
    //         response()->json([
    //             'message' => 'Validation failed',
    //             'errors' => $validator->errors(),
    //         ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
    //     );
    // }
}
