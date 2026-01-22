@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="dashboard-header">
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <p class="subtitle">Matric Number: {{ Auth::user()->matric_number }} | Department: {{ Auth::user()->department }}</p>
    </div>

    <div class="dashboard-stats">
        <div class="stat-box">
            <div class="stat-number">{{ $assignments->count() }}</div>
            <div class="stat-label">Active Assignments</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">{{ $submissions->count() }}</div>
            <div class="stat-label">Total Submissions</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">{{ $submissions->where('status', 'graded')->count() }}</div>
            <div class="stat-label">Graded</div>
        </div>
    </div>

    <div class="dashboard-content">
        <div class="content-section">
            <div class="section-header">
                <h2>Upcoming Assignments</h2>
                <a href="{{ route('student.assignments') }}" class="view-all">View All</a>
            </div>

            @if($assignments->count() > 0)
                <div class="assignments-list">
                    @foreach($assignments as $assignment)
                        <div class="assignment-item">
                            <div class="assignment-info">
                                <h3>{{ $assignment->title }}</h3>
                                <p class="course-info">{{ $assignment->course_code }} - {{ $assignment->course_title }}</p>
                                <p class="lecturer-info">Lecturer: {{ $assignment->lecturer->name }}</p>
                            </div>
                            <div class="assignment-meta">
                                <div class="due-date {{ $assignment->due_date->diffInDays(now()) <= 2 ? 'urgent' : '' }}">
                                    <span class="label">Due:</span>
                                    <span class="value">{{ $assignment->due_date->format('M d, Y h:i A') }}</span>
                                    <span class="relative">({{ $assignment->due_date->diffForHumans() }})</span>
                                </div>
                                <a href="{{ route('student.assignment.show', $assignment->id) }}" class="btn btn-small">View Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <p>No active assignments at the moment.</p>
                </div>
            @endif
        </div>

        <div class="content-section">
            <div class="section-header">
                <h2>Recent Submissions</h2>
                <a href="{{ route('student.submissions') }}" class="view-all">View All</a>
            </div>

            @if($submissions->count() > 0)
                <div class="submissions-list">
                    @foreach($submissions->take(5) as $submission)
                        <div class="submission-item">
                            <div class="submission-info">
                                <h4>{{ $submission->assignment->title }}</h4>
                                <p class="submission-date">Submitted: {{ $submission->submitted_at->format('M d, Y h:i A') }}</p>
                            </div>
                            <div class="submission-status">
                                <span class="badge {{ $submission->getStatusBadgeClass() }}">{{ ucfirst($submission->status) }}</span>
                                @if($submission->score)
                                    <span class="score">{{ $submission->score }}/{{ $submission->assignment->total_marks }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <p>You haven't submitted any assignments yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection