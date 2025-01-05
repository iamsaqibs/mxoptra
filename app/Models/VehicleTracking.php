<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleTracking extends Model
{
    protected $fillable = [
        'vehicle_id',
        'tracking_source',
        'device_id',
        'current_latitude',
        'current_longitude',
        'current_speed',
        'current_status',
        'tracking_data',
        'last_update',
    ];

    protected $casts = [
        'current_latitude' => 'decimal:8',
        'current_longitude' => 'decimal:8',
        'current_speed' => 'decimal:2',
        'tracking_data' => 'array',
        'last_update' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
