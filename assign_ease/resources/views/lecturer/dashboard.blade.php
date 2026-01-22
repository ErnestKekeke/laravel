@extends('layouts.app')

@section('title', 'Lecturer Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="dashboard-header">
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <p class="subtitle">Staff ID: {{ Auth::user()->staff_id }} | Department: {{ Auth::user()->department }}</p>
    </div>

    <div class="dashboard-stats">
        <div class="stat-box">
            <div class="stat-number">{{ $totalAssignments }}</div>
            <div class="stat-label">Total Assignments</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">{{ $totalSubmissions }}</div>
            <div class="stat-label">Total Submissions</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">{{ $assignments->count() }}</div>
            <div class="stat-label">Recent Assignments</div>
        </div>
    </div>

    <div class="dashboard-actions">
        <a href="{{ route('lecturer.create-assignment') }}" class="btn btn-primary">Create New Assignment</a>
        <a href="{{ route('lecturer.assignments') }}" class="btn btn-secondary">View All Assignments</a>
    </div>

    <div class="dashboard-content">
        <div class="content-section">
            <div class="section-header">
                <h2>Recent Assignments</h2>
            </div>

            @if($assignments->count() > 0)
                <div class="assignments-list">
                    @foreach($assignments as $assignment)
                        <div class="assignment-item">
                            <div class="assignment-info">
                                <h3>{{ $assignment->title }}</h3>
                                <p class="course-info">{{ $assignment->course_code }} - {{ $assignment->course_title }}</p>
                            </div>
                            <div class="assignment-meta">
                                <div class="due-date">
                                    <span class="label">Due:</span>
                                    <span class="value">{{ $assignment->due_date->format('M d, Y') }}</span>
                                </div>
                                <div class="submissions-count">
                                    <span class="count">{{ $assignment->submissions_count }}</span>
                                    <span class="label">Submissions</span>
                                </div>
                                <a href="{{ route('lecturer.assignment.show', $assignment->id) }}" class="btn btn-small">View</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <p>You haven't created any assignments yet.</p>
                    <a href="{{ route('lecturer.create-assignment') }}" class="btn btn-primary">Create Your First Assignment</a>
                </div>
            @endif
        </div>

        <div class="content-section">
            <div class="section-header">
                <h2>Recent Submissions</h2>
            </div>

            @if($recentSubmissions->count() > 0)
                <div class="submissions-list">
                    @foreach($recentSubmissions as $submission)
                        <div class="submission-item">
                            <div class="submission-info">
                                <h4>{{ $submission->student->name }}</h4>
                                <p class="assignment-title">{{ $submission->assignment->title }}</p>
                                <p class="submission-date">{{ $submission->submitted_at->format('M d, Y h:i A') }}</p>
                            </div>
                            <div class="submission-status">
                                <span class="badge {{ $submission->getStatusBadgeClass() }}">{{ ucfirst($submission->status) }}</span>
                                <a href="{{ route('lecturer.assignment.show', $submission->assignment_id) }}" class="btn btn-small">View</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <p>No submissions yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection