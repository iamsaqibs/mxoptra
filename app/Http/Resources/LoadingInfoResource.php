<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoadingInfoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'loadable_type' => $this->loadable_type,
            'loadable_id' => $this->loadable_id,
            'status' => $this->status,
            'items_loading_status' => $this->items_loading_status,
            'loading_started_at' => $this->loading_started_at,
            'loading_completed_at' => $this->loading_completed_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
