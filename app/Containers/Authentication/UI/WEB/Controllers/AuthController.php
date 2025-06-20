<?php

declare(strict_types=1);

namespace App\Containers\Authentication\UI\WEB\Controllers;

use App\Containers\Authentication\Actions\LoginAction;
use App\Containers\Authentication\Actions\RegisterAction;
use App\Containers\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\Authentication\UI\WEB\Requests\RegisterRequest;
use App\Models\User;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends WebController
{
    public function create(): Response
    {
        return Inertia::render('auth/Register');
    }

    public function loginForm(): Response
    {
        return Inertia::render('auth/Login');
    }

    public function register(RegisterRequest $request)
    {
        try {
            Log::info('Register request data:', $request->validated());
            
            $validated = $request->validated();
            
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            event(new Registered($user));

            Auth::login($user);

            return Redirect::route('dashboard')
                ->with('message', __('auth.register.success'));
        } catch (ValidationException $e) {
            Log::warning('Validation error:', [
                'errors' => $e->errors(),
            ]);
            
            return back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Registration error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withInput()
                ->withErrors(['error' => __('auth.register.failed')]);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $validated = $request->validated();
            
            if (!Auth::attempt($validated)) {
                throw ValidationException::withMessages([
                    'email' => [__('auth.login.invalid_credentials')],
                ]);
            }

            return Redirect::route('dashboard')
                ->with('message', __('auth.login.success'));

        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => __('auth.login.failed')]);
        }
    }

    public function logout()
    {
        Auth::logout();
        
        return Redirect::route('login')
            ->with('message', __('auth.logout.success'));
    }
} 