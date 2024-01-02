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
        Schema::create('presence_barcodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id');
            $table->foreignId('service_id');

            $table->string('title');
            $table->text('description')->nullable();
            $table->date('date');
            $table->string('day');
            $table->time('actual_hour_in')->comment('dari shift_hour_id');
            $table->time('actual_hour_out')->comment('dari shift_hour_id');
            $table->integer('actual_duration')->comment('dari shift_hour_id - satuan menit');

            $table->string('qr_code');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presence_barcodes');
    }
};
