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
        Schema::create('school_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id');
            $table->string('group_name');
            $table->string('group_code');
            $table->foreignId('school_shift_id');
            $table->foreignId('daily_presence_service_id');
            $table->foreignId('group_role_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_groups');
    }
};
