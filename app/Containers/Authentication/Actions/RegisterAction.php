<?php

declare(strict_types=1);

namespace App\Containers\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
use App\Traits\PropertyFillable;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterAction extends Action
{
    use PropertyFillable;

    private string $name;
    private string $email;
    private string $password;
    private string $deviceName;

    public function run(): User
    {
        return User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // return [
        //     'token' => $user->createToken($this->deviceName)->plainTextToken,
        //     'user' => $user,
        // ];
    }
} 