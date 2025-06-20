<?php

declare(strict_types=1);

namespace App\Containers\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
use App\Traits\PropertyFillable;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginAction extends Action
{
    use PropertyFillable;

    private string $email;
    private string $password;
    private string $deviceName;

    public function run(): array
    {
        $user = User::where('email', $this->email)->first();

        if (! $user || ! Hash::check($this->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return [
            'token' => $user->createToken($this->deviceName)->plainTextToken,
            'user' => $user,
        ];
    }
} 