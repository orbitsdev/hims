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

            //RECORD RELATIONSHIP
            $table->foreignId('record_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('recorder_id')->nullable();
            $table->foreignId('record_batch_id')->nullable();
            $table->foreignId('section_id')->nullable();
            $table->foreignId('course_id')->nullable();
            $table->foreignId('department_id')->nullable();
            $table->foreignId('condition_id')->nullable(); 
            $table->foreignId('blood_pressure_level_id')->nullable(); 
         
            //INDEPENDENT RECORD TO PRESERVE THA ACTUAL DATA
            // RECORD DETAILS
            $table->string('record_title')->nullable();
            $table->string('batch_description')->nullable();

            // DATES
            $table->string('academic_year_name')->nullable();
            $table->string('semester_name')->nullable();

            // UNIVERSITY DETAILS
            $table->string('department_name')->nullable();
            $table->text('course_name')->nullable();
            $table->string('section_name')->nullable();
            $table->string('student_unique_id')->nullable();
            $table->string('student_id_number')->nullable();
            $table->string('role')->nullable();

            // PERSONAL DETAILS
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('email')->nullable();
            $table->integer('age')->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->date('birth_date')->nullable();
            $table->text('birth_place')->nullable();
            $table->text('address')->nullable();
            $table->string('civil_status')->nullable();

            // MEDICAL RECORD
            $table->text('past_illness')->nullable();
            $table->text('allergies')->nullable();
            $table->decimal('temperature', 5, 2)->nullable();
            $table->string('blood_pressure')->nullable(); 
            $table->integer('systolic_pressure')->nullable(); 
            $table->integer('diastolic_pressure')->nullable(); 
            $table->integer('heart_rate')->nullable(); 
            $table->text('specified_diagnoses')->nullable(); 
            $table->text('diagnoses')->nullable(); 
            $table->text('condition_name')->nullable(); 
            
            $table->text('remarks')->nullable(); 
            $table->date('date_of_examination')->nullable(); 
            $table->string('release_by')->nullable(); 
            $table->string('physician_name')->nullable(); 
            $table->text('upload_image')->nullable(); 
            $table->text('captured_image')->nullable(); 
            $table->boolean('is_complete')->default(false)->nullable(); 


            $table->timestamps();
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
