<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distribution_center_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('locked_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('settings')->nullable();
            $table->timestamps();

            $table->unique(['distribution_center_id', 'start_date']);
            $table->index('distribution_center_id');
            $table->index('start_date');
            $table->index('end_date');
            $table->index('status');
            $table->index('is_active');
        });

        // Add schedule_id to shifts table
        Schema::table('shifts', function (Blueprint $table) {
            $table->foreignId('schedule_id')->nullable()->after('distribution_center_id')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->dropForeign(['schedule_id']);
            $table->dropColumn('schedule_id');
        });

        Schema::dropIfExists('schedules');
    }
};
