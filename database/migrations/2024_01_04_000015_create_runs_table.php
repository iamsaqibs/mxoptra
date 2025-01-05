<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shift_id')->constrained()->cascadeOnDelete();
            $table->integer('run_number');
            $table->integer('total_stops')->default(0);
            $table->decimal('total_distance', 10, 2)->default(0);
            $table->integer('duration_limit')->nullable(); // in seconds
            $table->decimal('distance_limit', 10, 2)->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_locked')->default(false);
            $table->timestamp('sent_to_driver_at')->nullable();
            $table->json('loading_info')->nullable();
            $table->timestamps();

            $table->unique(['shift_id', 'run_number']);
            $table->index('status');
            $table->index('is_locked');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('runs');
    }
};
