<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the HospitalSeeder
        $this->call([
            HospitalSeeder::class,
        ]);

        // Optional: Display success message
        $this->command->info('Hospital seeder completed successfully!');
        $this->command->info('10 hospitals have been added to the database.');
    }
}