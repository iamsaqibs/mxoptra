<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('distribution_center_id')->constrained()->cascadeOnDelete();
            $table->foreignId('schedule_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('shift_date');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('total_work_time')->default(0); // in seconds
            $table->integer('total_drive_time')->default(0); // in seconds
            $table->decimal('total_distance', 10, 2)->default(0);
            $table->integer('total_stops')->default(0);
            $table->integer('duration_limit')->nullable(); // in seconds
            $table->decimal('distance_limit', 10, 2)->nullable();
            $table->integer('run_number')->nullable();
            $table->json('break_times')->nullable();
            $table->json('loading_info')->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_locked')->default(false);
            $table->timestamp('sent_to_driver_at')->nullable();
            $table->json('settings')->nullable();
            $table->timestamps();

            $table->index('driver_id');
            $table->index('distribution_center_id');
            $table->index('schedule_id');
            $table->index('shift_date');
            $table->index('start_time');
            $table->index('end_time');
            $table->index('status');
            $table->index('is_active');
            $table->index('is_locked');
            $table->index('run_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
