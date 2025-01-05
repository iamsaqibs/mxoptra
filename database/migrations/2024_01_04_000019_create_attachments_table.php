<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('attachment_reference_number')->unique();
            $table->text('comment')->nullable();
            $table->string('image_small')->nullable();
            $table->string('image_full')->nullable();
            $table->timestamps();

            $table->index('order_id');
            $table->index('attachment_reference_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
