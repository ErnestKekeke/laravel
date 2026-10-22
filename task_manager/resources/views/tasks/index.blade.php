@extends('layouts.app')

@section('title', 'Task Dashboard')

@section('content')
    <div id="container-1">
        
        {{-- Conditional check for whether tasks exist --}}
        @isset($tasks)
            @if(count($tasks) > 0)

                <h3 id="h3-tag-task-info">Showing tasks for All Projects</h3>

                {{-- Main container required by js/app.js for Sortable & Filtering --}}
                <div id="tasks_container">
                    @foreach ($tasks as $task)
                        <div class="tasks" id="task_{{$task->id}}" task_project_id="{{ $task->project_id ?? 'null' }}" task_priority="{{$task->priority}}" draggable="true">
                            
                            <p>{{ $task->name }} &emsp;&emsp; <sup>(*{{$task->priority}})</sup></p> 

                            <div class="task-actions">
                                {{-- Edit Button --}}
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-edit">Edit</a>

                                {{-- Delete Form --}}
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 20px;">
                    <a href="{{ route('tasks.create') }}" class="btn btn-create">Add New Task</a>
                </div>

            @else
                <div class="empty-state">
                    <h3>No tasks found yet. Get started by creating your first task!</h3>
                    <a href="{{ route('tasks.create') }}" class="btn btn-create" style="margin-top: 15px;">Create Task</a>
                </div>
            @endif
        @endisset

    </div>

    {{-- Secondary container for project filtering dropdown --}}
    <div id="container-2" style="margin-top: 30px;">
        <h4>Available Projects</h4>

        <select class="projects">
            <option class="project" value="0">All Projects</option>
            @foreach ($projects as $project)
                <option class="project" value="{{ $project->id }}">
                    {{ $project->name }}
                </option>
            @endforeach
            <option class="project" value="-1">Unassigned</option>
        </select>  
    </div>

    <div class="spacer"></div>
@endsection

