<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('w3w_address', 256)->nullable();
            $table->string('postcode')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_valid')->default(false);
            $table->text('description')->nullable();
            $table->string('client_name')->nullable();
            $table->string('primary_telephone')->nullable();
            $table->string('secondary_telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            // Settings
            $table->boolean('allow_sms')->default(false);
            $table->boolean('allow_email')->default(false);
            $table->integer('fixed_time_per_address')->default(0);
            $table->integer('fixed_time_per_order')->default(0);
            $table->integer('time_per_capacity_delivery')->default(0);
            $table->json('preferred_driver_references')->nullable();
            $table->json('preferred_driver_names')->nullable();
            $table->json('vehicle_requirements_references')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
