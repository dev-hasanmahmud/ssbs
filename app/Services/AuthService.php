<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    use ApiResponse;

    public function createToken(User $user): string
    {
        return $user->createToken('api_token')->plainTextToken;
    }

    public function profile()
    {
        $data = User::with('bookings.service')->where('id', Auth::user()->id)->first();
        return $this->success($data, 'Profile retrieved');
    }

    public function logout(): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();
        
        return $this->success(null, 'Logged out successfully');
    }
}
