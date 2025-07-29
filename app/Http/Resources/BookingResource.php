<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'service'      => new ServiceResource($this->whenLoaded('service') ?? $this->service),
            'booking_date' => $this->booking_date,
            'status'       => $this->status,
            'created_at'   => $this->created_at,
            'user'         => $this->when(auth()->user()->is_admin, fn () => [
                'id'    => $this->user->id,
                'name'  => $this->user->name,
                'email' => $this->user->email,
            ])
        ];
    }
}
