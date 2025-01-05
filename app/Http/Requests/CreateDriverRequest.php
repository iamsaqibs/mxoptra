<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDriverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reference_number' => 'required|string|unique:drivers,reference_number',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email',
            'phone' => 'required|string|max:20',
            'territory_id' => 'required|string|exists:territories,id',
            'status' => 'required|string|in:ACTIVE,INACTIVE,ON_LEAVE,SUSPENDED',
            'license_number' => 'required|string|unique:drivers,license_number',
            'license_expiry' => 'required|date_format:Y-m-d',
            'vehicle_types' => 'required|array|min:1',
            'vehicle_types.*' => 'required|string|exists:vehicle_types,id',
            'availability' => 'required|array',
            'availability.monday' => 'required|array',
            'availability.monday.start' => 'required|date_format:H:i',
            'availability.monday.end' => 'required|date_format:H:i|after:availability.monday.start',
            'availability.tuesday' => 'required|array',
            'availability.tuesday.start' => 'required|date_format:H:i',
            'availability.tuesday.end' => 'required|date_format:H:i|after:availability.tuesday.start',
            'availability.wednesday' => 'required|array',
            'availability.wednesday.start' => 'required|date_format:H:i',
            'availability.wednesday.end' => 'required|date_format:H:i|after:availability.wednesday.start',
            'availability.thursday' => 'required|array',
            'availability.thursday.start' => 'required|date_format:H:i',
            'availability.thursday.end' => 'required|date_format:H:i|after:availability.thursday.start',
            'availability.friday' => 'required|array',
            'availability.friday.start' => 'required|date_format:H:i',
            'availability.friday.end' => 'required|date_format:H:i|after:availability.friday.start',
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
