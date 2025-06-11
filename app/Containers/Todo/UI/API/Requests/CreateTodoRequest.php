<?php

declare(strict_types=1);

namespace App\Containers\Todo\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Create Todo Request
 *
 * Handles validation for creating a new todo
 */
class CreateTodoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request
     */
    public function authorize(): bool
    {
        return true; // Add proper authorization logic as needed
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Get custom messages for validator errors
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The todo title is required.',
            'title.max' => 'The todo title cannot exceed 255 characters.',
            'description.max' => 'The description cannot exceed 1000 characters.',
        ];
    }
}
