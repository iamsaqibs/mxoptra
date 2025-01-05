<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->foreignId('shift_id')->constrained()->onDelete('cascade');
            $table->string('status');
            $table->text('notes')->nullable();
            $table->date('planned_date');
            $table->date('execution_date')->nullable();
            $table->timestamps();

            $table->index('reference_number');
            $table->index('location_id');
            $table->index('shift_id');
            $table->index('status');
            $table->index('planned_date');
            $table->index('execution_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
