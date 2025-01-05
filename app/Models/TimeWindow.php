<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class TimeWindow extends Model
{
    protected $fillable = [
        'timeable_type',
        'timeable_id',
        'start_time',
        'end_time',
        'day_of_week',
        'is_default',
        'is_holiday',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_default' => 'boolean',
        'is_holiday' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function timeable(): MorphTo
    {
        return $this->morphTo();
    }
}
