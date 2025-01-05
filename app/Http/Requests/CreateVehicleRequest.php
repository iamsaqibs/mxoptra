<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reference_number' => 'required|string|unique:vehicles,reference_number',
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:VAN,TRUCK,CAR,MOTORCYCLE',
            'registration_number' => 'required|string|unique:vehicles,registration_number',
            'territory_id' => 'required|string|exists:territories,id',
            'status' => 'required|string|in:ACTIVE,INACTIVE,MAINTENANCE',
            'capacity' => 'required|array',
            'capacity.weight' => 'required|numeric|min:0',
            'capacity.volume' => 'required|numeric|min:0',
            'capacity.pallets' => 'required|integer|min:0',
            'specifications' => 'required|array',
            'specifications.length' => 'required|numeric|min:0',
            'specifications.width' => 'required|numeric|min:0',
            'specifications.height' => 'required|numeric|min:0',
            'features' => 'nullable|array',
            'features.*' => 'string|in:TAIL_LIFT,REFRIGERATED,GPS_TRACKING,SIDE_LOADING',
            'maintenance_schedule' => 'nullable|array',
            'maintenance_schedule.last_service' => 'nullable|date',
            'maintenance_schedule.next_service' => 'nullable|date|after:maintenance_schedule.last_service',
            'maintenance_schedule.mileage' => 'nullable|integer|min:0',
            'cost_per_km' => 'nullable|numeric|min:0',
            'fuel_type' => 'required|string|in:PETROL,DIESEL,ELECTRIC,HYBRID',
            'fuel_efficiency' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'metadata' => 'nullable|array',
        ];
    }
}
