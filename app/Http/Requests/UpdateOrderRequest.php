<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $orderId = $this->route('id');

        return [
            'reference_number' => 'sometimes|required|string|unique:orders,reference_number,' . $orderId,
            'territory_id' => 'sometimes|required|string|exists:territories,id',
            'customer_id' => 'sometimes|required|string|exists:customers,id',
            'delivery_date' => 'sometimes|required|date_format:Y-m-d',
            'delivery_time_window' => 'sometimes|required|array',
            'delivery_time_window.start' => 'required_with:delivery_time_window|date_format:H:i',
            'delivery_time_window.end' => 'required_with:delivery_time_window|date_format:H:i|after:delivery_time_window.start',
            'status' => 'sometimes|required|string|in:PENDING,ASSIGNED,IN_PROGRESS,COMPLETED,CANCELLED',
            'priority' => 'nullable|integer|between:1,5',
            'items' => 'sometimes|required|array|min:1',
            'items.*.product_id' => 'required_with:items|string|exists:products,id',
            'items.*.quantity' => 'required_with:items|integer|min:1',
            'items.*.notes' => 'nullable|string',
            'delivery_address' => 'sometimes|required|array',
            'delivery_address.street' => 'required_with:delivery_address|string',
            'delivery_address.city' => 'required_with:delivery_address|string',
            'delivery_address.postcode' => 'required_with:delivery_address|string',
            'delivery_address.country' => 'required_with:delivery_address|string',
            'delivery_address.latitude' => 'required_with:delivery_address|numeric|between:-90,90',
            'delivery_address.longitude' => 'required_with:delivery_address|numeric|between:-180,180',
            'contact_details' => 'sometimes|required|array',
            'contact_details.name' => 'required_with:contact_details|string',
            'contact_details.phone' => 'required_with:contact_details|string',
            'contact_details.email' => 'nullable|email',
            'special_instructions' => 'nullable|string',
            'metadata' => 'nullable|array',
        ];
    }
}
