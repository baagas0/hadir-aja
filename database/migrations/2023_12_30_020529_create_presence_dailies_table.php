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
        Schema::create('presence_dailies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id');
            $table->foreignId('school_user_id');
            $table->foreignId('presence_location_id')->nullable();
            $table->foreignId('service_id');
            $table->foreignId('school_shift_id');
            $table->foreignId('school_shift_hour_id');

            $table->string('day')->comment('dari shift_hour_id');
            $table->time('actual_hour_in')->comment('dari shift_hour_id');
            $table->time('actual_hour_out')->comment('dari shift_hour_id');
            $table->integer('actual_duration')->comment('dari shift_hour_id - satuan menit');

            $table->date('presence_date');
            $table->string('presence_day');

            $table->string('attachment_in')->nullable();
            $table->json('face_match_in_response')->nullable();
            $table->time('hour_in')->nullable();
            $table->string('lat_in')->nullable();
            $table->string('long_in')->nullable();

            $table->string('attachment_out')->nullable();
            $table->json('face_match_out_response')->nullable();
            $table->time('hour_out')->nullable();
            $table->string('lat_out')->nullable();
            $table->string('long_out')->nullable();

            $table->integer('duration')->default(0)->comment('satuan menit');
            
            $table->enum('state', ['tidak diketahui', 'masuk', 'pulang'])->default('tidak diketahui');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'mangkir'])->default('mangkir');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presence_dailies');
    }
};
