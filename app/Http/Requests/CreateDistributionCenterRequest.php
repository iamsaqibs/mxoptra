<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDistributionCenterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reference_number' => 'required|string|unique:distribution_centers,reference_number',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|string',
            'country' => 'required|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'territory_id' => 'required|string|exists:territories,id',
            'status' => 'required|string|in:ACTIVE,INACTIVE,MAINTENANCE',
            'contact_details' => 'required|array',
            'contact_details.name' => 'required|string',
            'contact_details.phone' => 'required|string',
            'contact_details.email' => 'required|email',
            'operating_hours' => 'required|array',
            'operating_hours.monday' => 'required|array',
            'operating_hours.monday.start' => 'required|date_format:H:i',
            'operating_hours.monday.end' => 'required|date_format:H:i|after:operating_hours.monday.start',
            'operating_hours.tuesday' => 'required|array',
            'operating_hours.tuesday.start' => 'required|date_format:H:i',
            'operating_hours.tuesday.end' => 'required|date_format:H:i|after:operating_hours.tuesday.start',
            'operating_hours.wednesday' => 'required|array',
            'operating_hours.wednesday.start' => 'required|date_format:H:i',
            'operating_hours.wednesday.end' => 'required|date_format:H:i|after:operating_hours.wednesday.start',
            'operating_hours.thursday' => 'required|array',
            'operating_hours.thursday.start' => 'required|date_format:H:i',
            'operating_hours.thursday.end' => 'required|date_format:H:i|after:operating_hours.thursday.start',
            'operating_hours.friday' => 'required|array',
            'operating_hours.friday.start' => 'required|date_format:H:i',
            'operating_hours.friday.end' => 'required|date_format:H:i|after:operating_hours.friday.start',
            'operating_hours.saturday' => 'nullable|array',
            'operating_hours.saturday.start' => 'required_with:operating_hours.saturday|date_format:H:i',
            'operating_hours.saturday.end' => 'required_with:operating_hours.saturday|date_format:H:i|after:operating_hours.saturday.start',
            'operating_hours.sunday' => 'nullable|array',
            'operating_hours.sunday.start' => 'required_with:operating_hours.sunday|date_format:H:i',
            'operating_hours.sunday.end' => 'required_with:operating_hours.sunday|date_format:H:i|after:operating_hours.sunday.start',
            'capacity' => 'required|array',
            'capacity.storage' => 'required|array',
            'capacity.storage.pallets' => 'required|integer|min:0',
            'capacity.storage.volume' => 'required|numeric|min:0',
            'capacity.loading' => 'required|array',
            'capacity.loading.docks' => 'required|integer|min:0',
            'capacity.loading.vehicles_per_hour' => 'required|integer|min:0',
            'features' => 'nullable|array',
            'features.*' => 'string|in:COLD_STORAGE,HAZMAT,CROSS_DOCKING,AUTOMATED_SORTING',
            'notes' => 'nullable|string',
            'metadata' => 'nullable|array',
        ];
    }
}
