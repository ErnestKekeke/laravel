@extends('layouts.app')

@section('title', $task->exists ? 'Edit Task' : 'Create Task')

@section('content')
    <div id="container-3" class="form-card">
        <h2>{{ $task->exists ? 'Edit Task' : 'Create New Task' }}</h2>

        {{-- Display validation errors if any validation rules fail --}}
        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom: 20px;">
                <ul style="margin-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ $task->exists ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
            @csrf
            
            {{-- Spoof PUT method if we are editing an existing task --}}
            @if($task->exists)
                @method('PUT')
            @endif

            <div>
                <label for="name">Task Name</label>
                <input class="task-name" type="text" name="name" id="name" value="{{ old('name', $task->name) }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div>
                <label for="project_id">Project</label>
                <select name="project_id" id="project_id" class="projects" style="width: 100%; padding: 8px;">
                    <option value="">Unassigned</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Dynamic submit button matching creation vs updating state --}}
            @if($task->exists)
                <button type="submit" class="btn btn-update">Update Task</button>
            @else
                <button type="submit" class="btn btn-create">Create Task</button>
            @endif

        </form>
    </div>

    @if($task->exists)
        <div class="create-task">
            <a href="{{ route('tasks.create') }}">Switch to add New Task</a>
        </div>
    @endif
@endsection
