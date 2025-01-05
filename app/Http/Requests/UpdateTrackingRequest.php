<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrackingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'status' => 'nullable|string|in:NOT_STARTED,IN_TRANSIT,COMPLETED,FAILED,CANCELLED',
            'tracking_source' => 'nullable|string|in:GPS,MANUAL,MOBILE_APP,TOMTOM,OTHER',
            'device_id' => 'nullable|string|max:255',
            'current_speed' => 'nullable|numeric|min:0',
            'current_status' => 'nullable|string|in:MOVING,STOPPED,IDLE,OFFLINE',
            'tracking_data' => 'nullable|array',
            'tracking_data.*.timestamp' => 'nullable|date_format:Y-m-d\TH:i:s\Z',
            'tracking_data.*.location' => 'nullable|array',
            'tracking_data.*.location.latitude' => 'required_with:tracking_data.*.location|numeric|between:-90,90',
            'tracking_data.*.location.longitude' => 'required_with:tracking_data.*.location|numeric|between:-180,180',
            'tracking_data.*.speed' => 'nullable|numeric|min:0',
            'tracking_data.*.heading' => 'nullable|numeric|between:0,360',
            'tracking_data.*.altitude' => 'nullable|numeric',
            'tracking_data.*.accuracy' => 'nullable|numeric|min:0',
        ];
    }
}
