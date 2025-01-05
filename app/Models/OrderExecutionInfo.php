<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderExecutionInfo extends Model
{
    protected $table = 'order_execution_info';

    protected $fillable = [
        'order_reference_number',
        'driver_id',
        'vehicle_id',
        'status',
        'eta',
        'actual_arrival_time',
        'actual_departure_time',
        'reported_arrival_time',
        'reported_departure_time',
        'execution_notes',
    ];

    protected $casts = [
        'eta' => 'datetime',
        'actual_arrival_time' => 'datetime',
        'actual_departure_time' => 'datetime',
        'reported_arrival_time' => 'datetime',
        'reported_departure_time' => 'datetime',
        'execution_notes' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_reference_number', 'reference_number');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
