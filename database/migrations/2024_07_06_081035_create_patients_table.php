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
        Schema::create('patients', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('staff_id');
            $table->string('patientPaymentType'); // insurance, private or staff
            $table->string('referralSource')->nullable();
            $table->string('maritalStatus');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('prefix')->nullable();
            $table->string('dob');
            $table->string('gender');
            $table->string('occupation')->nullable();
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('email')->nullable();
            $table->string('nextofkinprefix')->nullable();
            $table->string('nextofkinfirstname');
            $table->string('nextofkinlastname');
            $table->string('nextofkinphone');
            $table->string('nextofkinemail')->nullable();
            $table->string('allergies')->nullable();
            $table->json('knownIllness')->nullable();
            $table->text('additional_information')->nullable();
            $table->timestamps();
            $table->foreign('staff_id')->references('id')->on('staffs')->OnDelete('restrict');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
