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
        Schema::create('presence_barcode_school_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_user_id');
            $table->foreignId('presence_barcode_id');

            $table->time('hour_in')->nullable()->comment('');
            $table->time('hour_out')->nullable()->comment('');
            $table->integer('duration')->default(0)->comment('satuan menit');

            $table->enum('state', ['tidak diketahui', 'masuk', 'pulang'])->default('tidak diketahui');
            $table->enum('status', ['hadir', 'izin', 'mangkir'])->default('mangkir');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presence_barcode_school_users');
    }
};
