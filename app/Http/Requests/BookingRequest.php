<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check(); // Only auth user can make bookings
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service_id'    => 'required|exists:services,id',
            'booking_date'  => 'required|date|after_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required' => 'Please select a service to book.',
            'service_id.exists'   => 'Selected service does not exist.',
            'booking_date.required' => 'Please provide a booking date.',
            'booking_date.after_or_equal' => 'Booking date cannot be in the past.',
        ];
    }
}
