<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

// namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// use Illuminate\Support\Facades\Hash;
// use App\Models\Clinic;
// use App\Models\Patient;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClinicSeeder::class,
            PatientSeeder::class,
        ]);
    }
}