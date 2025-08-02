<?php

namespace App\Services;

use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Models\Booking;
use Carbon\Carbon;

class BookingService
{
    public function __construct(protected BookingRepositoryInterface $repo) {}

    public function allForUser()
    {
        return $this->repo->newQuery()
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
    }

    public function allForAdmin()
    {
        return $this->repo->newQuery()
            ->with(['user', 'service'])
            ->latest()
            ->get();
    }

    public function store(array $data)
    {
        $data['booking_date'] = Carbon::parse($data['booking_date'])->format('Y-m-d');
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        $alreadyBooked = Booking::where('user_id', $data['user_id'])
            ->where('service_id', $data['service_id'])
            ->whereDate('booking_date', $data['booking_date'])
            ->exists();

        if ($alreadyBooked) {
            throw new \Exception('You have already booked this service on the selected date.', 409);
        }

        return Booking::create($data);
    }
}