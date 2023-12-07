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
        Schema::create('school_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id');
            $table->string('student_number')->unique();
            $table->string('student_name');
            $table->foreignId('school_group_id');
            $table->foreignId('school_position_id');
            $table->string('gender');
            $table->string('email');
            $table->string('phone_number');
            $table->date('birth_date');
            $table->string('selfie_img');
            $table->boolean('is_all_location_presence');
            $table->foreignId('school_location_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_users');
    }
};
