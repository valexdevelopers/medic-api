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
        Schema::create('patient_insurance_companies', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('patient_id');
            $table->string('primary_plan_holder');
            $table->string('patient_relationship');
            $table->string('policy_id');
            $table->string('group_id')->nullable();
            $table->ulid('insurance_company_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('patient_id')->references('id')->on('patients')->OnDelete('restrict');
            $table->foreign('insurance_company_id')->references('id')->on('insurance_companies')->OnDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_insurance_companies');
    }
};
