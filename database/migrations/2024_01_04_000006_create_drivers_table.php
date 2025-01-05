<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('skills')->nullable();
            $table->json('preferences')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
