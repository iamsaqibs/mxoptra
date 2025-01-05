<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consignments', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->foreignId('pickup_order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('delivery_order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('status')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['pickup_order_id', 'delivery_order_id']);
            $table->index('status');
            $table->index('reference_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consignments');
    }
};
