<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Imports the Project model.
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creates the Personal project 
        Project::create([
            'name' => 'Personal',
        ]);

        // Creates the Work project 
        Project::create([
            'name' => 'Work',
        ]);

        // Creates the Study project
        Project::create([
            'name' => 'Study',
        ]);

    }
}
