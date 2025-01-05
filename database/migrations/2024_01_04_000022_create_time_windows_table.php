<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('time_windows', function (Blueprint $table) {
            $table->id();
            $table->morphs('timeable'); // For orders, locations, etc.
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('day_of_week')->nullable(); // For recurring time windows
            $table->boolean('is_default')->default(false);
            $table->boolean('is_holiday')->default(false);
            $table->timestamps();

            $table->index(['timeable_type', 'timeable_id']);
            $table->index('start_time');
            $table->index('end_time');
            $table->index('day_of_week');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_windows');
    }
};
