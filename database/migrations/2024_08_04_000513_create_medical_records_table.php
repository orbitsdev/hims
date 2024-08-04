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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();

            // //RECORD RELATIONSHIP
            // $table->foreignId('record_id')->nullable();
            // $table->foreignId('account_id')->nullable();
            // $table->foreignId('record_batch_id')->nullable();
            // $table->string('academic_year_name')->nullable();
            // $table->string('semester_name')->nullable();
            // //RECORD RELATIONSHIP

       
            // $table->string('first_name')->nullable();
            // $table->string('last_name')->nullable();
            // $table->string('middle_name')->nullable();
            // $table->string('maiden_name')->nullable();
            // $table->integer('age')->nullable();
            // $table->string('civil_status')->nullable();
            // $table->text('birth_place')->nullable();
            // $table->date('birth_date')->nullable();
            // $table->string('address')->nullable();
            // $table->timestamps();

            // // STUDENT DETAILS
            // $table->foreignId('section_id')->nullable();
            // $table->foreignId('section_id')->nullable();
            // //
            // // INDEPENDENT RECORD
            // $table->foreignId('section_name')->nullable();
            // $table->foreignId('department_name')->nullable();
            // $table->string('unique_id')->unique()->nullable();
            // $table->string('id_number')->unique()->nullable();
            // $table->foreignId('department_id')->nullable();
            // $table->string('department_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
