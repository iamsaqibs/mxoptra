<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $vehicleId = $this->route('id');

        return [
            'reference_number' => 'sometimes|required|string|unique:vehicles,reference_number,' . $vehicleId,
            'name' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string|in:VAN,TRUCK,CAR,MOTORCYCLE',
            'registration_number' => 'sometimes|required|string|unique:vehicles,registration_number,' . $vehicleId,
            'territory_id' => 'sometimes|required|string|exists:territories,id',
            'status' => 'sometimes|required|string|in:ACTIVE,INACTIVE,MAINTENANCE',
            'capacity' => 'sometimes|required|array',
            'capacity.weight' => 'required_with:capacity|numeric|min:0',
            'capacity.volume' => 'required_with:capacity|numeric|min:0',
            'capacity.pallets' => 'required_with:capacity|integer|min:0',
            'specifications' => 'sometimes|required|array',
            'specifications.length' => 'required_with:specifications|numeric|min:0',
            'specifications.width' => 'required_with:specifications|numeric|min:0',
            'specifications.height' => 'required_with:specifications|numeric|min:0',
            'features' => 'nullable|array',
            'features.*' => 'string|in:TAIL_LIFT,REFRIGERATED,GPS_TRACKING,SIDE_LOADING',
            'maintenance_schedule' => 'nullable|array',
            'maintenance_schedule.last_service' => 'nullable|date',
            'maintenance_schedule.next_service' => 'nullable|date|after:maintenance_schedule.last_service',
            'maintenance_schedule.mileage' => 'nullable|integer|min:0',
            'cost_per_km' => 'nullable|numeric|min:0',
            'fuel_type' => 'sometimes|required|string|in:PETROL,DIESEL,ELECTRIC,HYBRID',
            'fuel_efficiency' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'metadata' => 'nullable|array',
        ];
    }
}
