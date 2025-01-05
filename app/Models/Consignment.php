<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consignment extends Model
{
    protected $fillable = [
        'reference_number',
        'pickup_order_id',
        'delivery_order_id',
        'status',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pickupOrder(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'pickup_order_id');
    }

    public function deliveryOrder(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'delivery_order_id');
    }
}
