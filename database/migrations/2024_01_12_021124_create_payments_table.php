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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('school_id')->nullable();
            $table->foreignId('package_id')->nullable();
            $table->string('payment');
            $table->string('merchant_ref');
            $table->string('reference')->unique();
            $table->decimal('amount', 13, 2)->nullable();
            $table->decimal('amount_received', 13, 2);
            $table->enum('status', ['UNPAID', 'PAID', 'REFUND', 'EXPIRED', 'FAILED']);
            $table->tinyInteger('approval_status')->default(0);
            $table->timestamp('approval_at')->nullable();
            $table->timestamp('expired_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
