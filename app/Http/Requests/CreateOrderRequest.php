<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reference_number' => 'required|string|unique:orders,reference_number',
            'territory_id' => 'required|string|exists:territories,id',
            'customer_id' => 'required|string|exists:customers,id',
            'delivery_date' => 'required|date_format:Y-m-d',
            'delivery_time_window' => 'required|array',
            'delivery_time_window.start' => 'required|date_format:H:i',
            'delivery_time_window.end' => 'required|date_format:H:i|after:delivery_time_window.start',
            'status' => 'required|string|in:PENDING,ASSIGNED,IN_PROGRESS,COMPLETED,CANCELLED',
            'priority' => 'nullable|integer|between:1,5',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|string|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.notes' => 'nullable|string',
            'delivery_address' => 'required|array',
            'delivery_address.street' => 'required|string',
            'delivery_address.city' => 'required|string',
            'delivery_address.postcode' => 'required|string',
            'delivery_address.country' => 'required|string',
            'delivery_address.latitude' => 'required|numeric|between:-90,90',
            'delivery_address.longitude' => 'required|numeric|between:-180,180',
            'contact_details' => 'required|array',
            'contact_details.name' => 'required|string',
            'contact_details.phone' => 'required|string',
            'contact_details.email' => 'nullable|email',
            'special_instructions' => 'nullable|string',
            'metadata' => 'nullable|array',
        ];
    }
}
