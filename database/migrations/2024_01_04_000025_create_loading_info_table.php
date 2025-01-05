<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loading_info', function (Blueprint $table) {
            $table->id();
            $table->morphs('loadable');
            $table->string('status')->nullable();
            $table->json('items_loading_status')->nullable();
            $table->timestamp('loading_started_at')->nullable();
            $table->timestamp('loading_completed_at')->nullable();
            $table->timestamps();

            $table->index(['loadable_type', 'loadable_id', 'status']);
            $table->index(['loading_started_at', 'loading_completed_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loading_info');
    }
};
