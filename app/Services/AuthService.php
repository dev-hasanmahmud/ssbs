<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    use ApiResponse;

    public function authUser(): User
    {
        $user = auth()->user();

        if (! $user || !($user instanceof User)) {
            throw new \Exception('Unauthenticated', 401);
        }

        return $user;
    }

    public function createToken(User $user): string
    {
        if (empty($user) || !($user instanceof User)) {
            throw new \Exception('User not provided for token creation.', 400);
        }

        return $user->createToken('api_token')->plainTextToken;
    }

    public function register(array $data)
    {
        if (empty($data)) {
            throw new \Exception('Data cannot be empty', 400);
        }

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = $this->createToken($user);

        return compact('user', 'token');
    }

    public function login(string $email, string $password)
    {
        if (empty($email)) {
            throw new \Exception('Email is required.', 400);
        }

        if (empty($password)) {
            throw new \Exception('Password is required.', 400);
        }

        $user = User::where('email', $email)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            throw new \Exception('Invalid credentials', 401);
        }

        $token = $this->createToken($user);

        return compact('user', 'token');
    }

    public function logout(): void
    {
        $user = auth()->user();

        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        } else {
            throw new \Exception('User not authenticated or no token found', 401);
        }
    }
}
