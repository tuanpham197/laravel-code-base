<?php

return [
    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    'register' => [
        'success' => 'Registration successful!',
        'failed' => 'Registration failed. Please try again.',
    ],

    'login' => [
        'success' => 'Login successful!',
        'failed' => 'Login failed. Please try again.',
        'invalid_credentials' => 'Email or password is incorrect.',
    ],

    'logout' => [
        'success' => 'Logout successful!',
    ],

    'validation' => [
        'name' => [
            'required' => 'Name is required',
            'min' => 'Name must be at least 3 characters',
            'max' => 'Name cannot exceed 50 characters',
        ],
        'email' => [
            'required' => 'Email is required',
            'email' => 'Invalid email format',
            'max' => 'Email cannot exceed 50 characters',
            'unique' => 'This email is already registered',
        ],
        'password' => [
            'required' => 'Password is required',
            'min' => 'Password must be at least 8 characters',
            'confirmed' => 'Password confirmation does not match',
        ],
    ],
]; 