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
        Schema::create('school_billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id');
            $table->foreignId('package_id');
            $table->text('merchant_ref');
            $table->double('price');
            $table->string('billing_code')->nullable();
            $table->integer('payment_duration')->default(1)->comment('1 bulan - 3 bulan - 6 bulan');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['pending', 'paid', 'expired', 'suspend']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_billings');
    }
};
