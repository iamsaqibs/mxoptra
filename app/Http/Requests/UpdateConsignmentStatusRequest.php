<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConsignmentStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|string|in:CREATED,PICKUP_PENDING,PICKUP_COMPLETED,DELIVERY_PENDING,DELIVERY_COMPLETED,CANCELLED',
        ];
    }
}
