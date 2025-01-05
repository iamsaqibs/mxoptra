<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->string('tracking_source')->nullable();
            $table->string('device_id')->nullable();
            $table->decimal('current_latitude', 10, 8)->nullable();
            $table->decimal('current_longitude', 11, 8)->nullable();
            $table->decimal('current_speed', 5, 2)->nullable();
            $table->string('current_status')->nullable();
            $table->json('tracking_data')->nullable();
            $table->timestamp('last_update')->nullable();
            $table->timestamps();

            $table->index(['vehicle_id', 'tracking_source']);
            $table->index(['current_latitude', 'current_longitude']);
            $table->index('device_id');
            $table->index('last_update');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_tracking');
    }
};
