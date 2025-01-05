<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoadingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'nullable|string|in:NOT_STARTED,IN_PROGRESS,COMPLETED,FAILED,CANCELLED',
            'items_loading_status' => 'nullable|array',
            'items_loading_status.*' => 'array',
            'items_loading_status.*.item_id' => 'required|string',
            'items_loading_status.*.status' => 'required|string|in:NOT_LOADED,LOADED,DAMAGED,MISSING,PARTIALLY_LOADED',
            'items_loading_status.*.quantity' => 'nullable|integer|min:0',
            'items_loading_status.*.notes' => 'nullable|string',
            'items_loading_status.*.timestamp' => 'nullable|date_format:Y-m-d\TH:i:s\Z',
            'items_loading_status.*.location' => 'nullable|array',
            'items_loading_status.*.location.latitude' => 'required_with:items_loading_status.*.location|numeric|between:-90,90',
            'items_loading_status.*.location.longitude' => 'required_with:items_loading_status.*.location|numeric|between:-180,180',
        ];
    }
}
