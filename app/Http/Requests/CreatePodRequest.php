<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'signature' => 'required|string',
            'signature_timestamp' => 'nullable|date_format:Y-m-d\TH:i:s\Z',
            'signed_by' => 'required|string|max:255',
            'notes' => 'nullable|array',
            'notes.*.note' => 'required|string',
            'notes.*.created_at' => 'nullable|date_format:Y-m-d\TH:i:s\Z',
            'notes.*.user_id' => 'nullable|string|exists:users,id',
            'status' => 'required|string|in:PENDING,SIGNED,VERIFIED,REJECTED',
            'metadata' => 'nullable|array',
            'photos' => 'nullable|array',
            'photos.*' => 'image|max:10240', // Max 10MB per photo
        ];
    }
}
