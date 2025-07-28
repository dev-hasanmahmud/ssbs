<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\{
    AuthController,
    ServiceController,
    BookingController,
};
use App\Http\Controllers\API\V1\Admin\AdminBookingController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Customer Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/services', [ServiceController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings', [BookingController::class, 'index']);

    // Routes for Admin only
    Route::middleware('admin')->group(function () {
        Route::post('/services', [ServiceController::class, 'store']);
        Route::put('/services/{id}', [ServiceController::class, 'update']);
        Route::delete('/services/{id}', [ServiceController::class, 'destroy']);
        Route::get('/admin/bookings', [AdminBookingController::class, 'index']);
    });
});
