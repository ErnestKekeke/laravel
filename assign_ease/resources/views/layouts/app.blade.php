<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Assignment Management System')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a href="{{ route('home') }}">
                    <span class="logo">AMS</span>
                    <span class="system-name">Assignment Management System</span>
                </a>
            </div>
            <div class="navbar-menu">
                @auth
                    @if(Auth::user()->isStudent())
                        <a href="{{ route('student.dashboard') }}">Dashboard</a>
                        <a href="{{ route('student.assignments') }}">Assignments</a>
                        <a href="{{ route('student.submissions') }}">My Submissions</a>
                    @elseif(Auth::user()->isLecturer())
                        <a href="{{ route('lecturer.dashboard') }}">Dashboard</a>
                        <a href="{{ route('lecturer.assignments') }}">My Assignments</a>
                        <a href="{{ route('lecturer.create-assignment') }}">Create Assignment</a>
                    @endif
                    <div class="user-menu">
                        <span>{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-logout">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Nigerian Universities Assignment Management System. All rights reserved.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>