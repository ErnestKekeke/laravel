<html>
    @vite('resources/css/app.css')
    <script>
        window.csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js" defer="true"></script>
  

<head></head>

<body>
    <div id="container-1">


        {{-- Dynamic & Session Alert Container --}}
        <div id="alert-container">
            {{-- Success Flash Message Notification --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            {{-- Error Flash Message Notification --}}
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>

       
    
        @isset($tasks)

            <h3 id="h3-tag-task-info">Showing tasks for All Projects</h3>

            <div id="tasks_container">

                @foreach ($tasks as $task)
                    <div class="tasks" id="task_{{$task->id}}" task_project_id="{{ 
                        $task->project_id ?? 'null' }}" 
                        task_priority = "{{$task->priority}}" draggable="true">
                        <p> {{ $task->name }} &emsp;&emsp; <sup>(*{{$task->priority}})</sup> </p> 

                        {{-- Edit Button (Redirects to edit form) --}}
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-edit">Edit</a>

                        {{-- Delete Button (Submits DELETE request via form) --}}
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="delete-task" class=" btn btn-delete" 
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                @endforeach

            </div>

            <a href="{{ route('tasks.create') }}" class="create-task">Add New Task</a>

        @else
        
            <h3> No Tasks Yet, please add a new Task </h3>
        
        @endisset

    </div>


    <div id="container-2">
        <h4>available projects</h4>

        <select class="projects">
            <option class="project" value="0">All Projects</option>
            @foreach ($projects as $project)
                {{-- <option id="project_{{$project->id}}" value="{{ $project->id }}"> --}}
                <option class="project" value="{{ $project->id }}">
                    {{ $project->name }}</option>
            @endforeach
            <option class="project" value="-1">Unassigned</option>
        </select>  
    </div>


    <div class="spacer"></div>

 
    @vite('resources/js/app.js')
</body>


</html>