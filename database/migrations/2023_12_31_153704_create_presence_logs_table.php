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
        Schema::create('presence_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_user_id');
            $table->dateTime('datetime')->useCurrent();
            $table->string('ref_table');
            $table->string('ref_id');
            $table->string('type');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presence_logs');
    }
};
