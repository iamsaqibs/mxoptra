<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateConsignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pickup_order_id' => 'required|string|exists:orders,id',
            'delivery_order_id' => 'required|string|exists:orders,id',
            'reference_number' => 'required|string|unique:consignments,reference_number',
            'metadata' => 'nullable|array',
        ];
    }
}
