<?php

declare(strict_types=1);

namespace App\Containers\Authentication\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends Request
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
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => __('auth.validation.name.required'),
            'name.min' => __('auth.validation.name.min'),
            'name.max' => __('auth.validation.name.max'),
            'email.required' => __('auth.validation.email.required'),
            'email.email' => __('auth.validation.email.email'),
            'email.max' => __('auth.validation.email.max'),
            'email.unique' => __('auth.validation.email.unique'),
            'password.required' => __('auth.validation.password.required'),
            'password.min' => __('auth.validation.password.min'),
            'password.confirmed' => __('auth.validation.password.confirmed'),
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