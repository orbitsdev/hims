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
        Schema::create('blood_pressure_levels', function (Blueprint $table) {
            $table->id();
        
            $table->string('level_name'); // Normal, Elevated, etc.
            $table->integer('systolic_min')->nullable(); // Minimum systolic value
            $table->integer('systolic_max')->nullable(); // Maximum systolic value
            $table->integer('diastolic_min')->nullable(); // Minimum diastolic value
            $table->integer('diastolic_max')->nullable(); // Maximum diastolic value
            $table->integer('age_min')->nullable(); // Minimum age
            $table->integer('age_max')->nullable(); //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_pressure_levels');
    }
};
