@extends('layouts.app')

@section('title', 'Welcome to Task Manager')

@section('content')
    <div class="welcome-hero">
        <h1>Organize Your Work & Projects Effortlessly</h1>
        <p>A simple, fast, and interactive task management tool designed to streamline your 
            daily workflow and help you stay organized and focused on your priorities. 
            Developed by <b>Ernest Kekeke</b> using Laravel.</p>
        
        <div class="hero-actions">
            <a href="{{ route('tasks.index') }}" class="btn btn-update">View Task Dashboard</a>
            <a href="{{ route('tasks.create') }}" class="btn btn-create">Create a New Task</a>
        </div>
    </div>
@endsection 