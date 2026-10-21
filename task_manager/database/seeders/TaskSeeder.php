<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Imports model.
use App\Models\Task;
use App\Models\Project;

class TaskSeeder extends Seeder
{

    public function run(): void
    {
        // Retrieves each project by name.
        $personal = Project::where('name', 'Personal')->first();
        $work = Project::where('name', 'Work')->first();
        $study = Project::where('name', 'Study')->first();

        // Creates tasks for the Personal project.
        Task::create([
            'name' => 'Buy groceries',
            'priority' => 6,
            'project_id' => $personal->id,
        ]);

        Task::create([
            'name' => 'Exercise for 30 minutes',
            'priority' => 8,
            'project_id' => $personal->id,
        ]);

        Task::create([
            'name' => 'Clean the room',
            'priority' => 10,
            'project_id' => $personal->id,
        ]);

        // Creates tasks for the Work project.
        Task::create([
            'name' => 'Complete daily report',
            'priority' => 1,
            'project_id' => $work->id,
        ]);

        Task::create([
            'name' => 'Attend team meeting',
            'priority' => 4,
            'project_id' => $work->id,
        ]);

        Task::create([
            'name' => 'Reply to emails',
            'priority' => 7,
            'project_id' => $work->id,
        ]);

        // Creates tasks for the Study project.
        Task::create([
            'name' => 'Prepare for exams',
            'priority' => 2,
            'project_id' => $study->id,
        ]);

        Task::create([
            'name' => 'Complete homework',
            'priority' => 3,
            'project_id' => $study->id,
        ]);

        // Creates tasks without an associated project.
        Task::create([
            'name' => 'Check on a friend',
            'priority' => 5,
            'project_id' => null,
        ]);

        Task::create([
            'name' => 'Watch a movie',
            'priority' => 9,
            'project_id' => null,
        ]);
    }
 
}
