<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PodInformation extends Model
{
    protected $table = 'pod_information';

    protected $fillable = [
        'order_reference_number',
        'signature_image',
        'signature_name',
        'signature_timestamp',
        'metadata',
        'notes',
    ];

    protected $casts = [
        'signature_timestamp' => 'datetime',
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_reference_number', 'reference_number');
    }
}
