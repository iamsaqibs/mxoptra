<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('settings')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('reference_number');
            $table->index('is_active');
        });

        // Create pivot tables for vehicle requirement relationships
        Schema::create('location_vehicle_requirement', function (Blueprint $table) {
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vehicle_requirement_id')->constrained()->cascadeOnDelete();
            $table->primary(['location_id', 'vehicle_requirement_id'], 'location_vehicle_req_primary');
        });

        Schema::create('vehicle_vehicle_requirement', function (Blueprint $table) {
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vehicle_requirement_id')->constrained()->cascadeOnDelete();
            $table->primary(['vehicle_id', 'vehicle_requirement_id'], 'vehicle_vehicle_req_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_vehicle_requirement');
        Schema::dropIfExists('location_vehicle_requirement');
        Schema::dropIfExists('vehicle_requirements');
    }
};
