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
        Schema::create('patient_accounts', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('staff_id');
            $table->ulid('patient_id');
            $table->int('amount');
            $table->string('payment_method');
            $table->string('invoice_number');
            $table->string('reference');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('staff_id')->references('id')->on('staffs')->OnDelete('restrict');
            $table->foreign('patient_id')->references('id')->on('patients')->OnDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_accounts');
    }
};
