<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Services\BookingService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    use ApiResponse;

    public function __construct(protected BookingService $srv) {}

    /**
     * Customer: Book a service
     *
     * @param BookingRequest $request
     * @return JsonResponse
     */
    public function store(BookingRequest $request): JsonResponse
    {
        $booking = $this->srv->store($request->validated());

        return $this->success(
            new BookingResource($booking),
            'Service booked successfully',
            201
        );
    }

    /**
     * Customer: List their own bookings
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $bookings = $this->srv->allForUser();

        return $this->success(
            BookingResource::collection($bookings),
            'Your bookings fetched successfully'
        );
    }
}
