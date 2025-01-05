<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('distribution_centers', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('postcode');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->boolean('is_active')->default(true);
            $table->json('settings')->nullable();
            $table->timestamps();

            $table->index('reference_number');
            $table->index('postcode');
            $table->index('is_active');
            $table->spatialIndex(['latitude', 'longitude']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('distribution_centers');
    }
};
