@extends('layouts.app')

@section('title', 'All Assignments')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <h1>All Assignments</h1>
    </div>

    <div class="filter-tabs">
        <button class="tab-btn active" data-filter="all">All Assignments</button>
        <button class="tab-btn" data-filter="upcoming">Upcoming</button>
        <button class="tab-btn" data-filter="overdue">Overdue</button>
    </div>

    @if($assignments->count() > 0)
        <div class="assignments-grid">
            @foreach($assignments as $assignment)
                <div class="assignment-card {{ $assignment->isOverdue() ? 'overdue-card' : '' }}">
                    <div class="assignment-card-header">
                        <h3>{{ $assignment->title }}</h3>
                        @if($assignment->isOverdue())
                            <span class="status-badge overdue">Overdue</span>
                        @else
                            <span class="status-badge active">Active</span>
                        @endif
                    </div>
                    
                    <div class="assignment-card-body">
                        <p class="course-info">{{ $assignment->course_code }} - {{ $assignment->course_title }}</p>
                        <p class="lecturer-name">Lecturer: {{ $assignment->lecturer->name }}</p>
                        <p class="description-preview">{{ Str::limit($assignment->description, 100) }}</p>
                        
                        <div class="assignment-meta-info">
                            <div class="meta-item">
                                <span class="meta-label">Due Date:</span>
                                <span class="meta-value {{ $assignment->isOverdue() ? 'text-danger' : '' }}">
                                    {{ $assignment->due_date->format('M d, Y h:i A') }}
                                </span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Total Marks:</span>
                                <span class="meta-value">{{ $assignment->total_marks }}</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Time Left:</span>
                                <span class="meta-value {{ $assignment->isOverdue() ? 'text-danger' : '' }}">
                                    {{ $assignment->isOverdue() ? 'Overdue' : $assignment->due_date->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="assignment-card-footer">
                        <a href="{{ route('student.assignment.show', $assignment->id) }}" class="btn btn-primary btn-small">
                            View & Submit
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination-wrapper">
            {{ $assignments->links() }}
        </div>
    @else
        <div class="empty-state-large">
            <div class="empty-icon">📝</div>
            <h2>No Assignments Available</h2>
            <p>There are no assignments available at the moment. Check back later.</p>
        </div>
    @endif
</div>
@endsection