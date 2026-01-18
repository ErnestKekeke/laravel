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
        Schema::create('clinics', function (Blueprint $table) {
            $table->char('clinic_id', 4)->primary();
            $table->string('clinic_name')->unique();
            $table->enum('clinic_type', [
                'general',
                'dental',
                'diagnostic',
                'specialty',
                'pediatric',
                'surgical',
                'maternity',
                'mental_health',
                'rehab',
                'community',
                'alternative'
            ]);
            $table->string('reg_no')->unique();
            $table->date('lic_issue_dt');
            $table->enum('accred_status', ['none', 'pending', 'accredited'])->default('none');
            $table->string('med_dir');
            $table->string('email')->unique();
            $table->string('contact_no');
            $table->text('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
