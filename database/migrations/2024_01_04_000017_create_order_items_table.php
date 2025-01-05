<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('item_reference_number')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('barcode')->nullable();
            $table->string('status')->nullable();
            $table->string('reject_reason')->nullable();
            $table->text('reject_comment')->nullable();
            $table->decimal('price_per_unit', 10, 2)->default(0);
            $table->integer('planned_quantity')->default(0);
            $table->integer('fact_quantity')->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('height', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('volume', 10, 2)->nullable();
            $table->timestamps();

            $table->index('order_id');
            $table->index('item_reference_number');
            $table->index('barcode');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
