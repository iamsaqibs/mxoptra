<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Location extends Model
{
    protected $fillable = [
        'reference_number',
        'name',
        'address',
        'w3w_address',
        'postcode',
        'latitude',
        'longitude',
        'description',
        'client_name',
        'primary_telephone',
        'secondary_telephone',
        'email',
        'website',
        'settings',
        'is_active',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'settings' => 'array',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function timeWindows(): MorphMany
    {
        return $this->morphMany(TimeWindow::class, 'timeable');
    }

    public function vehicleRequirements(): BelongsToMany
    {
        return $this->belongsToMany(VehicleRequirement::class);
    }
}
