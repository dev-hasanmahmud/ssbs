<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Services\BookingService;
use App\Traits\{
    ApiResponse,
    HandleAPIException
};
use Illuminate\Http\JsonResponse;

class AdminBookingController extends Controller
{
    use ApiResponse, HandleAPIException;

    public function __construct(protected BookingService $srv) {}

    /**
     * Display a listing of all bookings (admin only).
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->handleExceptions(function () {
            $bookings = $this->srv->allForAdmin();

            return $this->success(
                BookingResource::collection($bookings),
                'All bookings fetched'
            );
        });
    }
}
