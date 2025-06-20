<?php

declare(strict_types=1);

namespace App\Containers\Authentication\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class LoginRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'email.required' => __('auth.validation.email.required'),
            'email.email' => __('auth.validation.email.email'),
            'password.required' => __('auth.validation.password.required'),
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $formattedErrors = [];

        foreach ($errors->messages() as $field => $messages) {
            $formattedErrors[$field] = is_array($messages) ? $messages[0] : $messages;
        }

        Log::warning('Validation failed:', [
            'errors' => $formattedErrors,
            'input' => $this->all()
        ]);

        throw ValidationException::withMessages($formattedErrors);
    }
} 