<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('event'); // ORDER_STATUS_UPDATED, etc.
            $table->string('url');
            $table->string('secret')->nullable();
            $table->string('filter_status')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('reference_number');
            $table->index('event');
            $table->index('is_active');
        });

        Schema::create('subscription_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained()->cascadeOnDelete();
            $table->integer('response_code');
            $table->string('event');
            $table->json('payload');
            $table->text('response')->nullable();
            $table->timestamps();

            $table->index('subscription_id');
            $table->index('event');
            $table->index('response_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_logs');
        Schema::dropIfExists('subscriptions');
    }
};
