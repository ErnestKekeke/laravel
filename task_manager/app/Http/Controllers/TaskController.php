<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display the list of tasks ordered by priority alongside available projects
    public function index()
    {
        $tasks = Task::orderBy('priority', 'asc')->get();
        $projects = Project::all();

        return view('tasks.index', compact('tasks', 'projects'));
    }

    // Load the form with a new, empty Task instance for creation
    public function create()
    {
        return view('tasks.edit_create', [
            'task' => new Task(),
            'projects' => Project::all(),
        ]);
    }

    // Validate and store a brand new task, auto-assigning it the next priority number
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:6',
                'max:255',
                // This regex looks through the string and ensures there are at least 6 letters (a-z or A-Z)
                'regex:/^(?=(?:[^a-zA-Z]*[a-zA-Z]){6,}).*$/'
            ],
            'project_id' => 'nullable|exists:projects,id',
        ], [
            // Custom error message so it reads clearly for users
            'name.regex' => 'The task name must contain at least 6 alphabetic letters.'
        ]); 

        // Automatically place the new task at the bottom of the list
        $validated['priority'] = (Task::max('priority') ?? 0) + 1;

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    // Load the form pre-filled with an existing task for editing
    public function edit(Task $task)
    {
        return view('tasks.edit_create', [
            'task' => $task,
            'projects' => Project::all(),
        ]);
    }

    // Validate and update an existing task
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:6',
                'max:255',
                // This regex looks through the string and ensures there are at least 6 letters (a-z or A-Z)
                'regex:/^(?=(?:[^a-zA-Z]*[a-zA-Z]){6,}).*$/'
            ],
            'project_id' => 'nullable|exists:projects,id',
        ], [
            // Custom error message so it reads clearly for users
            'name.regex' => 'The task name must contain at least 6 alphabetic letters.'
        ]);
        
        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    // Delete a task and automatically shift up the priorities of remaining tasks
    public function destroy(Task $task)
    {
        $deletedPriority = $task->priority;

        $task->delete();

        // Shift up remaining task priorities to fill the gap
        Task::where('priority', '>', $deletedPriority)
            ->decrement('priority');

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    // Handle asynchronous drag-and-drop reordering from SortableJS
    public function reorder(Request $request)
    {
        $request->validate([
            'tasks_ids' => 'required|array'
        ]);

        foreach ($request->input('tasks_ids') as $index => $task_id) {
            Task::where('id', $task_id)->update([
                'priority' => $index + 1  // Reassign based on new array order
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task priorities updated successfully!'
        ]);
    }
}