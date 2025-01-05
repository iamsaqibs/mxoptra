<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model
{
    protected $fillable = [
        'reference_number',
        'name',
        'comment',
        'telephone',
        'assigned_vehicle_id',
        'cost_per_hour',
        'distribution_center_id',
        'start_of_day_location',
        'start_of_day_address',
        'visit_distribution_centre_start',
        'end_of_day_location',
        'end_of_day_address',
        'visit_distribution_centre_end',
        'driving_limit',
        'run_duration_limit',
        'duty_time_limit',
        'availability',
    ];

    protected $casts = [
        'cost_per_hour' => 'decimal:2',
        'driving_limit' => 'integer',
        'run_duration_limit' => 'integer',
        'duty_time_limit' => 'integer',
        'availability' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function distributionCenter(): BelongsTo
    {
        return $this->belongsTo(DistributionCenter::class);
    }

    public function assignedVehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'assigned_vehicle_id');
    }

    public function territories(): BelongsToMany
    {
        return $this->belongsToMany(Territory::class);
    }

    public function shifts(): HasMany
    {
        return $this->hasMany(Shift::class);
    }

    public function orderExecutions(): HasMany
    {
        return $this->hasMany(OrderExecutionInfo::class);
    }
}
