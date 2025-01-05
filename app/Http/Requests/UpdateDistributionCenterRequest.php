<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDistributionCenterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $centerId = $this->route('id');

        return [
            'reference_number' => 'sometimes|required|string|unique:distribution_centers,reference_number,' . $centerId,
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string',
            'city' => 'sometimes|required|string',
            'postcode' => 'sometimes|required|string',
            'country' => 'sometimes|required|string',
            'latitude' => 'sometimes|required|numeric|between:-90,90',
            'longitude' => 'sometimes|required|numeric|between:-180,180',
            'territory_id' => 'sometimes|required|string|exists:territories,id',
            'status' => 'sometimes|required|string|in:ACTIVE,INACTIVE,MAINTENANCE',
            'contact_details' => 'sometimes|required|array',
            'contact_details.name' => 'required_with:contact_details|string',
            'contact_details.phone' => 'required_with:contact_details|string',
            'contact_details.email' => 'required_with:contact_details|email',
            'operating_hours' => 'sometimes|required|array',
            'operating_hours.monday' => 'sometimes|required|array',
            'operating_hours.monday.start' => 'required_with:operating_hours.monday|date_format:H:i',
            'operating_hours.monday.end' => 'required_with:operating_hours.monday|date_format:H:i|after:operating_hours.monday.start',
            'operating_hours.tuesday' => 'sometimes|required|array',
            'operating_hours.tuesday.start' => 'required_with:operating_hours.tuesday|date_format:H:i',
            'operating_hours.tuesday.end' => 'required_with:operating_hours.tuesday|date_format:H:i|after:operating_hours.tuesday.start',
            'operating_hours.wednesday' => 'sometimes|required|array',
            'operating_hours.wednesday.start' => 'required_with:operating_hours.wednesday|date_format:H:i',
            'operating_hours.wednesday.end' => 'required_with:operating_hours.wednesday|date_format:H:i|after:operating_hours.wednesday.start',
            'operating_hours.thursday' => 'sometimes|required|array',
            'operating_hours.thursday.start' => 'required_with:operating_hours.thursday|date_format:H:i',
            'operating_hours.thursday.end' => 'required_with:operating_hours.thursday|date_format:H:i|after:operating_hours.thursday.start',
            'operating_hours.friday' => 'sometimes|required|array',
            'operating_hours.friday.start' => 'required_with:operating_hours.friday|date_format:H:i',
            'operating_hours.friday.end' => 'required_with:operating_hours.friday|date_format:H:i|after:operating_hours.friday.start',
            'operating_hours.saturday' => 'nullable|array',
            'operating_hours.saturday.start' => 'required_with:operating_hours.saturday|date_format:H:i',
            'operating_hours.saturday.end' => 'required_with:operating_hours.saturday|date_format:H:i|after:operating_hours.saturday.start',
            'operating_hours.sunday' => 'nullable|array',
            'operating_hours.sunday.start' => 'required_with:operating_hours.sunday|date_format:H:i',
            'operating_hours.sunday.end' => 'required_with:operating_hours.sunday|date_format:H:i|after:operating_hours.sunday.start',
            'capacity' => 'sometimes|required|array',
            'capacity.storage' => 'required_with:capacity|array',
            'capacity.storage.pallets' => 'required_with:capacity.storage|integer|min:0',
            'capacity.storage.volume' => 'required_with:capacity.storage|numeric|min:0',
            'capacity.loading' => 'required_with:capacity|array',
            'capacity.loading.docks' => 'required_with:capacity.loading|integer|min:0',
            'capacity.loading.vehicles_per_hour' => 'required_with:capacity.loading|integer|min:0',
            'features' => 'nullable|array',
            'features.*' => 'string|in:COLD_STORAGE,HAZMAT,CROSS_DOCKING,AUTOMATED_SORTING',
            'notes' => 'nullable|string',
            'metadata' => 'nullable|array',
        ];
    }
}
