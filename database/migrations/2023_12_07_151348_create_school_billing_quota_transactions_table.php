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
        Schema::create('school_billing_quota_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id');
            $table->foreignId('school_billing_id');
            $table->foreignId('school_billing_quota_id');
            $table->foreignId('service_id');
            $table->dateTime('datetime')->useCurrent();
            $table->string('ref_table');
            $table->string('ref_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_billing_quota_transactions');
    }
};
