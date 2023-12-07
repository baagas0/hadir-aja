<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('school_shift_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id');
            $table->foreignId('school_shift_id');
            $table->string('day');
            $table->integer('day_in');
            $table->time('hour_in');
            $table->time('hour_out');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_shift_hours');
    }
};
