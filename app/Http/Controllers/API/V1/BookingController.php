<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        return Booking::with('service')->where('user_id', auth()->id())->get();
    }

    public function store(BookingRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        $booking = Booking::create($data);

        return response()->json($booking, 201);
    }
}

