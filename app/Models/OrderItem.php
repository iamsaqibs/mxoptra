<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'item_reference_number',
        'order_reference_number',
        'name',
        'description',
        'barcode',
        'status',
        'reject_reason',
        'reject_comment',
        'price_per_unit',
        'planned_quantity',
        'fact_quantity',
        'total_amount',
        'height',
        'width',
        'length',
        'weight',
        'volume',
    ];

    protected $casts = [
        'price_per_unit' => 'decimal:2',
        'planned_quantity' => 'decimal:2',
        'fact_quantity' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'height' => 'decimal:2',
        'width' => 'decimal:2',
        'length' => 'decimal:2',
        'weight' => 'decimal:2',
        'volume' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_reference_number', 'reference_number');
    }
}
