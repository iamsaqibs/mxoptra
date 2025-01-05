<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRunRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reference_number' => 'required|string|unique:runs,reference_number',
            'territory_id' => 'required|string|exists:territories,id',
            'driver_id' => 'required|string|exists:drivers,id',
            'vehicle_id' => 'required|string|exists:vehicles,id',
            'start_time' => 'required|date_format:Y-m-d\TH:i:s\Z',
            'end_time' => 'required|date_format:Y-m-d\TH:i:s\Z|after:start_time',
            'status' => 'required|string|in:PENDING,ASSIGNED,IN_PROGRESS,COMPLETED,CANCELLED',
            'orders' => 'nullable|array',
            'orders.*.order_id' => 'required|string|exists:orders,id',
            'orders.*.sequence' => 'required|integer|min:1',
            'orders.*.estimated_arrival' => 'required|date_format:Y-m-d\TH:i:s\Z|after:start_time|before:end_time',
            'orders.*.estimated_completion' => 'required|date_format:Y-m-d\TH:i:s\Z|after:orders.*.estimated_arrival|before:end_time',
            'break_times' => 'nullable|array',
            'break_times.*.start_time' => 'required|date_format:Y-m-d\TH:i:s\Z|after:start_time|before:end_time',
            'break_times.*.end_time' => 'required|date_format:Y-m-d\TH:i:s\Z|after:break_times.*.start_time|before:end_time',
            'break_times.*.type' => 'required|string|in:LUNCH,REST,MAINTENANCE,OTHER',
            'notes' => 'nullable|string',
            'metadata' => 'nullable|array',
        ];
    }
}
