<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Ernest Kekeke">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Task Manager')</title>

    <!-- Load styles and scripts via Laravel Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Local SortableJS script asset --}}
    <script src="{{ asset('js/sortable.min.js') }}" defer></script>
</head>

<body> 

    <!-- Global Navigation Bar -->
    <header class="app-header">
        <nav class="nav-container">
            <a href="{{ url('/') }}" class="logo">TaskFlow</a>
            <div class="nav-links">
                <a href="{{ route('tasks.index') }}">Dashboard</a>
                <a href="{{ route('tasks.create') }}">New Task</a>
            </div>
        </nav>
    </header>

    <!-- Main Page Wrapper -->
    <main class="main-content">
        
        <!-- Flash Message & Dynamic JS Alert Container -->
        <div id="alert-container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <!-- Yield page specific content here -->
        @yield('content')

    </main>

    <!-- Global Footer -->
    <footer class="app-footer">
        <p>&copy; {{ date('Y') }} Task Manager. Built with Laravel by <b>Ernest Kekeke</b></p>
    </footer>

    <!-- Make CSRF token available globally for asynchronous fetch requests -->
    <script>
        window.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script>

    <!-- Stack for allowing individual views to inject custom page scripts -->
    @stack('scripts')

</body>
</html>
