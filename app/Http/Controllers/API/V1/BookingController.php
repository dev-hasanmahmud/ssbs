<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use Carbon\Carbon;
use App\Models\Booking;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    use ApiResponse;

    /**
     * Customer: Book a service
     *
     * @param BookingRequest $request
     * @return JsonResponse
     */
    public function store(BookingRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['booking_date'] = Carbon::parse($data['booking_date'])->format('Y-m-d');
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        // Prevent duplicate bookings
        $alreadyBooked = Booking::where('user_id', $data['user_id'])
            ->where('service_id', $data['service_id'])
            ->whereDate('booking_date', $data['booking_date'])
            ->exists();

        if ($alreadyBooked) {
            return $this->error('You have already booked this service on the selected date.', 409);
        }

        $booking = Booking::create($data);

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
        $bookings = Booking::where('user_id', auth()->id())->latest()->get();

        return $this->success(
            BookingResource::collection($bookings),
            'Your bookings fetched successfully'
        );
    }
}
