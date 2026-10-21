<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    // Displays the list of tasks and projects.
    public function index()
    {
        // Retrieves all tasks ordered by priority (so #1 is at the top).
        $tasks = Task::orderBy('priority', 'asc')->get();

        // Retrieves all projects from the database.
        $projects = Project::all();

        // Passes the tasks and projects to the index view.
        return view('tasks.index', compact('tasks', 'projects'));
    }


    public function create()
    {
        // Pass a brand new, empty Task instance
        return view('tasks.edit_create', ['task' => new Task(),
                                         'projects' => Project::all(),
                                         ]);
    }

    //........
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        // Automatically determine the next priority number for the new task
        $maxPriority = Task::max('priority') ?? 0;
        $validated['priority'] = $maxPriority + 1;

        // 3. Create the task using the validated data
        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    // // show each task details Not In Used 
    // public function show(Task $task){}
 


    public function edit(Task $task)
    {
        // Pass the existing task fetched via Route Model Binding
        return view('tasks.edit_create', ['task' => $task,
                                         'projects' => Project::all(),
                                         ]);
    }


    //....................
    public function update(Request $request, Task $task)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        // Update the existing task
        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    // ............
    public function destroy(Task $task)
    {
        $deletedPriority = $task->priority;

        // Delete the task
        $task->delete();

        // Shift down the priority of all tasks that came after the deleted one
        Task::where('priority', '>', $deletedPriority)
            ->decrement('priority');

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }


    // ..................
    public function reorder(Request $request)
    {
        // Validate that 'tasks_ids' is present and is an array
        $request->validate([
            'tasks_ids' => 'required|array'
        ]);

        // Loop through the array and update priority based on the new array index
        foreach ($request->input('tasks_ids') as $index => $task_id) {
            // $index starts at 0, so priority becomes 1, 2, 3, etc.
            Task::where('id', $task_id)->update([
                'priority' => $index + 1
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task priorities updated successfully!'
        ]);
    }

}



