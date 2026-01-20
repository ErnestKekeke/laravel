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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();

            // Basic info
            $table->string('hospital_name')->unique();
            $table->enum('hospital_type', [
                'general',
                'specialty',
                'teaching',
                'tertiary',
                'community',
                'pediatric',
                'maternity',
                'psychiatric',
                'rehabilitation',
                'surgical',
                'diagnostic',
                'dental'
            ]);
            $table->string('reg_no')->unique();
            $table->date('lic_issue_dt');
            $table->enum('accred_status', ['none', 'pending', 'accredited'])->default('none');
            $table->string('med_dir');

            // Ownership & capacity
            $table->enum('ownership', ['government', 'private', 'charitable']);
            $table->unsignedInteger('beds')->default(0);

            // Contact info
            $table->string('email')->unique();
            $table->string('contact_no');
            $table->text('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');

            // Location
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Hospital logo path
            $table->string('logo_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
