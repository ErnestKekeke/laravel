<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Runs the ProjectSeeder first, then the TaskSeeder.
        $this->call([
            ProjectSeeder::class,
            TaskSeeder::class,
        ]);
    }
}
