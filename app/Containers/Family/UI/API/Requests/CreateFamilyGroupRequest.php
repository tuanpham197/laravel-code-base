<?php

declare(strict_types=1);

namespace App\Containers\Family\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

class CreateFamilyGroupRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'family_name' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
} 