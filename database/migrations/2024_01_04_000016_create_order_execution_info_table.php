<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_execution_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('vehicle_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('run_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamp('planned_arrival_time')->nullable();
            $table->timestamp('planned_completion_time')->nullable();
            $table->integer('stop_number')->nullable();
            $table->integer('total_stops_in_run')->nullable();
            $table->timestamp('eta')->nullable();
            $table->timestamp('fact_arrival_time_gps')->nullable();
            $table->timestamp('fact_completion_time_gps')->nullable();
            $table->timestamp('fact_arrival_time_reported')->nullable();
            $table->timestamp('fact_completion_time_reported')->nullable();
            $table->string('fail_reason')->nullable();
            $table->text('fail_comment')->nullable();
            $table->string('status')->nullable();
            $table->integer('run_number')->nullable();
            $table->timestamps();

            $table->index('order_id');
            $table->index('driver_id');
            $table->index('vehicle_id');
            $table->index('run_id');
            $table->index('status');
            $table->index('run_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_execution_info');
    }
};
