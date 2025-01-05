<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Order extends Model
{
    protected $fillable = [
        'reference_number',
        'location_id',
        'shift_id',
        'status',
        'notes',
        'planned_date',
        'execution_date',
        'consignment_reference',
        'distribution_center_id',
        'task',
        'priority',
        'additional_instructions',
        'client_name',
        'contact_person',
        'contact_number',
        'contact_email',
        'additional_contact_emails',
        'notification_preferences',
        'territory_reference',
        'stop_sequence',
        'capacity1',
        'capacity2',
        'operation_duration',
        'custom_fields',
        'price',
    ];

    protected $casts = [
        'planned_date' => 'date',
        'execution_date' => 'date',
        'additional_contact_emails' => 'array',
        'notification_preferences' => 'array',
        'custom_fields' => 'array',
        'price' => 'decimal:2',
        'capacity1' => 'decimal:2',
        'capacity2' => 'decimal:2',
        'operation_duration' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

    public function distributionCenter(): BelongsTo
    {
        return $this->belongsTo(DistributionCenter::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    public function executionInfo(): HasOne
    {
        return $this->hasOne(OrderExecutionInfo::class);
    }

    public function podInformation(): HasOne
    {
        return $this->hasOne(PodInformation::class);
    }

    public function timeWindows(): MorphMany
    {
        return $this->morphMany(TimeWindow::class, 'timeable');
    }
}
