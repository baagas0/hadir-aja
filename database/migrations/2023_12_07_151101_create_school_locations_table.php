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
        Schema::create('school_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id');
            $table->string('title');
            $table->text('address');
            $table->text('location');
            $table->string('lat');
            $table->string('long');
            $table->integer('radius_distance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_locations');
    }
};
