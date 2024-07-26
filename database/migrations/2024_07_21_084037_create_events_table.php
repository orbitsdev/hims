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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')->nullable();
            $table->foreignId('semester_id')->nullable();
            $table->text('title')->nullable();
            $table->text('content')->nullable();
            $table->text('description')->nullable();
            // $table->dateTime('event_date')->nullable(); // Se
            $table->date('event_date')->nullable(); // Se
            $table->text('image')->nullable();
            $table->boolean('is_published')->nullable();
            $table->timestamps();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
