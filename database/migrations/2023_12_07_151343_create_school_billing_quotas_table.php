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
        Schema::create('school_billing_quotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_billing_id');
            $table->foreignId('package_id');
            $table->foreignId('service_id');
            $table->string('service_code');
            $table->integer('user_count');
            $table->integer('limit_quota');
            $table->integer('used_quota');
            $table->integer('remaining_quota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_billing_quotas');
    }
};
