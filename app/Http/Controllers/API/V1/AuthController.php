<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\{
    LoginRequest, 
    RegisterRequest
};
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use App\Traits\{
    ApiResponse,
    HandleAPIException
};
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use ApiResponse, HandleAPIException;

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register a new user
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        return $this->handleExceptions(function () use ($request) {
            $result = $this->authService->register($request->validated());

            return $this->success([
                'token' => $result['token'],
                'user'  => new UserResource($result['user']),
            ], 'User registered successfully', 201);
        });
    }

    /**
     * Login user and return token
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->handleExceptions(function () use ($request) {
            $result = $this->authService->login($request->email, $request->password);

            return $this->success([
                'token' => $result['token'],
                'user'  => new UserResource($result['user']),
            ], 'Login successful');
        });
    }

    /**
     * Get authenticated user profile
     *
     * @return JsonResponse
     */
    public function profile(): JsonResponse
    {
        return $this->handleExceptions(function () {
            $user = $this->authService->authUser();

            return $this->success(
                new UserResource($user),
                'User profile retrieved successfully'
            );
        });
    }

    /**
     * Logout user
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        return $this->handleExceptions(function () {
            $this->authService->logout();

            return $this->success(null, 'Logged out successfully');
        });
    }
}
