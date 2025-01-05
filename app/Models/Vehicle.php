<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vehicle extends Model
{
    protected $fillable = [
        'reference_number',
        'name',
        'assigned_device',
        'tracking_source',
        'max_speed',
        'driving_time_correction_factor',
        'cost_per_distance',
        'activation_cost',
        'cost_per_order',
        'capacity1',
        'capacity2',
        'run_distance_limit',
        'distribution_center_id',
        'assigned_driver_id',
        'comment',
        'manufacturer',
        'vin',
        'is_stand_down',
        'is_archived',
        'color',
    ];

    protected $casts = [
        'max_speed' => 'decimal:2',
        'driving_time_correction_factor' => 'decimal:2',
        'cost_per_distance' => 'decimal:2',
        'activation_cost' => 'decimal:2',
        'cost_per_order' => 'decimal:2',
        'capacity1' => 'decimal:2',
        'capacity2' => 'decimal:2',
        'run_distance_limit' => 'decimal:2',
        'is_stand_down' => 'boolean',
        'is_archived' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function distributionCenter(): BelongsTo
    {
        return $this->belongsTo(DistributionCenter::class);
    }

    public function assignedDriver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'assigned_driver_id');
    }

    public function territories(): BelongsToMany
    {
        return $this->belongsToMany(Territory::class);
    }

    public function vehicleRequirements(): BelongsToMany
    {
        return $this->belongsToMany(VehicleRequirement::class);
    }
}
