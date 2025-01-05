<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $driverId = $this->route('id');

        return [
            'reference_number' => 'sometimes|required|string|unique:drivers,reference_number,' . $driverId,
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:drivers,email,' . $driverId,
            'phone' => 'sometimes|required|string|max:20',
            'territory_id' => 'sometimes|required|string|exists:territories,id',
            'status' => 'sometimes|required|string|in:ACTIVE,INACTIVE,ON_LEAVE,SUSPENDED',
            'license_number' => 'sometimes|required|string|unique:drivers,license_number,' . $driverId,
            'license_expiry' => 'sometimes|required|date_format:Y-m-d',
            'vehicle_types' => 'sometimes|required|array|min:1',
            'vehicle_types.*' => 'required|string|exists:vehicle_types,id',
            'availability' => 'sometimes|required|array',
            'availability.monday' => 'sometimes|required|array',
            'availability.monday.start' => 'required_with:availability.monday|date_format:H:i',
            'availability.monday.end' => 'required_with:availability.monday|date_format:H:i|after:availability.monday.start',
            'availability.tuesday' => 'sometimes|required|array',
            'availability.tuesday.start' => 'required_with:availability.tuesday|date_format:H:i',
            'availability.tuesday.end' => 'required_with:availability.tuesday|date_format:H:i|after:availability.tuesday.start',
            'availability.wednesday' => 'sometimes|required|array',
            'availability.wednesday.start' => 'required_with:availability.wednesday|date_format:H:i',
            'availability.wednesday.end' => 'required_with:availability.wednesday|date_format:H:i|after:availability.wednesday.start',
            'availability.thursday' => 'sometimes|required|array',
            'availability.thursday.start' => 'required_with:availability.thursday|date_format:H:i',
            'availability.thursday.end' => 'required_with:availability.thursday|date_format:H:i|after:availability.thursday.start',
            'availability.friday' => 'sometimes|required|array',
            'availability.friday.start' => 'required_with:availability.friday|date_format:H:i',
            'availability.friday.end' => 'required_with:availability.friday|date_format:H:i|after:availability.friday.start',
            'availability.saturday' => 'nullable|array',
            'availability.saturday.start' => 'required_with:availability.saturday|date_format:H:i',
            'availability.saturday.end' => 'required_with:availability.saturday|date_format:H:i|after:availability.saturday.start',
            'availability.sunday' => 'nullable|array',
            'availability.sunday.start' => 'required_with:availability.sunday|date_format:H:i',
            'availability.sunday.end' => 'required_with:availability.sunday|date_format:H:i|after:availability.sunday.start',
            'skills' => 'nullable|array',
            'skills.*' => 'string',
            'metadata' => 'nullable|array',
        ];
    }
}
