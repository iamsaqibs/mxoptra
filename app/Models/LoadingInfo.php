<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class LoadingInfo extends Model
{
    protected $fillable = [
        'loadable_type',
        'loadable_id',
        'status',
        'items_loading_status',
        'loading_started_at',
        'loading_completed_at',
    ];

    protected $casts = [
        'items_loading_status' => 'array',
        'loading_started_at' => 'datetime',
        'loading_completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function loadable(): MorphTo
    {
        return $this->morphTo();
    }
}
