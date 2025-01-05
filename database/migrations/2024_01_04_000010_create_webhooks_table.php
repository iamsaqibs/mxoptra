<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('event_type');
            $table->string('url');
            $table->json('headers')->nullable();
            $table->json('filters')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_triggered_at')->nullable();
            $table->integer('retry_count')->default(0);
            $table->timestamps();

            $table->index('event_type');
            $table->index('is_active');
            $table->index('last_triggered_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webhooks');
    }
};
