@extends('layouts.app')

@section('title', 'Home - Assignment Management System')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<div class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1>Online Assignment Submission Management System</h1>
            <p class="hero-subtitle">Empowering Nigerian Universities with Digital Assignment Management</p>
            <div class="hero-buttons">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">Get Started</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Register Now</a>
                @else
                    @if(Auth::user()->isStudent())
                        <a href="{{ route('student.dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                    @elseif(Auth::user()->isLecturer())
                        <a href="{{ route('lecturer.dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                    @endif
                @endguest
            </div>
        </div>
    </div>
</div>

<div class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📚</div>
                <div class="stat-number">{{ $stats['total_assignments'] }}</div>
                <div class="stat-label">Total Assignments</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👨‍🏫</div>
                <div class="stat-number">{{ $stats['total_lecturers'] }}</div>
                <div class="stat-label">Lecturers</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👨‍🎓</div>
                <div class="stat-number">{{ $stats['total_students'] }}</div>
                <div class="stat-label">Students</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📝</div>
                <div class="stat-number">{{ $stats['total_submissions'] }}</div>
                <div class="stat-label">Submissions</div>
            </div>
        </div>
    </div>
</div>

<div class="features-section">
    <div class="container">
        <h2 class="section-title">Key Features</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🚀</div>
                <h3>Easy Submission</h3>
                <p>Students can submit assignments online with just a few clicks. Supports PDF, DOC, and DOCX formats.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⏰</div>
                <h3>Deadline Tracking</h3>
                <p>Automatic tracking of assignment deadlines. Students receive clear indicators for due dates.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Progress Monitoring</h3>
                <p>Lecturers can view submission statistics and track student progress in real-time.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">✅</div>
                <h3>Grading System</h3>
                <p>Efficient grading interface with feedback mechanism for better student learning.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3>Secure Storage</h3>
                <p>All submissions are securely stored and accessible only to authorized users.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3>Mobile Friendly</h3>
                <p>Access the system from any device - desktop, tablet, or smartphone.</p>
            </div>
        </div>
    </div>
</div>

<div class="cta-section">
    <div class="container">
        <h2>Ready to Get Started?</h2>
        <p>Join thousands of students and lecturers using our platform</p>
        @guest
            <a href="{{ route('register') }}" class="btn btn-large">Register Today</a>
        @endguest
    </div>
</div>
@endsection