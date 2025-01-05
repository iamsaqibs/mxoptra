<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('territories', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('boundaries')->nullable(); // Polygon/MultiPolygon coordinates
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('reference_number');
            $table->index('is_active');
        });

        // Create pivot tables for territory relationships
        Schema::create('driver_territory', function (Blueprint $table) {
            $table->foreignId('driver_id')->constrained()->cascadeOnDelete();
            $table->foreignId('territory_id')->constrained()->cascadeOnDelete();
            $table->primary(['driver_id', 'territory_id']);
        });

        Schema::create('vehicle_territory', function (Blueprint $table) {
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->foreignId('territory_id')->constrained()->cascadeOnDelete();
            $table->primary(['vehicle_id', 'territory_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_territory');
        Schema::dropIfExists('driver_territory');
        Schema::dropIfExists('territories');
    }
};
