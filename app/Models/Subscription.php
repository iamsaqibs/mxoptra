<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    protected $fillable = [
        'reference_number',
        'event',
        'url',
        'secret',
        'filter_status',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [
        'secret',
    ];

    public function logs(): HasMany
    {
        return $this->hasMany(SubscriptionLog::class);
    }
}
