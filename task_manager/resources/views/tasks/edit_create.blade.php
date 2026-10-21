<html>
 @vite('resources/css/app.css')

<div id="container-3">
    <form action="{{ $task->exists ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
        @csrf
        
        {{-- If the task exists, spoof the PUT method for updating --}}
        @if($task->exists)
            @method('PUT')
        @endif

        <div>
            <label for="name">Task Name</label>
            {{-- old() falls back to the database value if editing, or empty if creating --}}
            <input class="task-name" type="text" name="name" id="name" value="{{ old('name', $task->name) }}">
        </div>

    
                {{-- <option class="project" value="null">Unassigned</option> --}}
    
        <div>
            <label for="project_id">Project</label>
            <select name="project_id" id="project_id" class="projects">
                <option value="" >Unassigned</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" 
                        {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Dynamic Button Text --}} 

        @if($task->exists)
            <button type="submit" class="btn btn-update">Update Task</button>
        @else
            <button type="submit" class="btn btn-create">Create Task</button>
        @endif

    </form>

</div>


    {{-- If the task exists, spoof the PUT method for updating --}}
    @if($task->exists)
        <a href="{{ route('tasks.create') }}" class="create-task">Add New Task</a>
    @endif

</html>

