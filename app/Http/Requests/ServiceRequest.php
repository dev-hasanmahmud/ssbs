<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin; // Only admin can manage services
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'status'      => 'required|in:active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Service name is required.',
            'price.required'   => 'Price is required.',
            'price.numeric'    => 'Price must be a valid number.',
            'status.in'        => 'Status must be active or inactive.',
        ];
    }
}
