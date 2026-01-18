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
            $table->id();
            
            // Foreign Key - Clinic Relationship (matching your clinics table)
            $table->char('clinic_id', 4);
            $table->foreign('clinic_id')->references('clinic_id')->on('clinics')->onDelete('cascade');
            
            // Personal Information
            $table->string('patient_id')->unique()->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female']);
            $table->string('photo_path')->nullable();
            
            // Contact Information
            $table->string('phone');
            $table->string('email')->nullable();
            $table->text('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('postal_code')->nullable();
            
            // Laboratory Results
            $table->date('test_date');
            $table->enum('hbsag', ['positive', 'negative', 'pending']);
            $table->enum('anti_hbs', ['positive', 'negative', 'pending'])->nullable();
            $table->enum('hbeag', ['positive', 'negative', 'pending'])->nullable();
            $table->integer('viral_load')->nullable();
            $table->integer('alt_level')->nullable();
            $table->integer('ast_level')->nullable();
            $table->integer('platelet_count')->nullable();
            $table->text('lab_notes')->nullable();
            
            // Treatment Information
            $table->enum('diagnosis_type', ['acute', 'chronic', 'carrier', 'resolved']);
            $table->enum('treatment_status', ['on_treatment', 'not_started', 'monitoring', 'completed']);
            $table->enum('vaccination_status', ['fully_vaccinated', 'partially_vaccinated', 'not_vaccinated']);
            $table->text('prescribed_medication')->nullable();
            $table->date('next_appointment')->nullable();
            $table->string('doctor_name')->nullable();
            $table->text('treatment_notes')->nullable();
            
            $table->timestamps();
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