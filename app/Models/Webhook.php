<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    protected $fillable = [
        'event_type',
        'url',
        'headers',
        'filters',
        'is_active',
        'last_triggered_at',
        'retry_count',
    ];

    protected $casts = [
        'headers' => 'array',
        'filters' => 'array',
        'is_active' => 'boolean',
        'last_triggered_at' => 'datetime',
        'retry_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
