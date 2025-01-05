<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackingInfoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'current_location' => [
                'latitude' => $this->current_latitude,
                'longitude' => $this->current_longitude,
            ],
            'status' => $this->status,
            'tracking_history' => $this->tracking_history,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
