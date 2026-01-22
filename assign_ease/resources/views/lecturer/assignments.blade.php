@extends('layouts.app')

@section('title', 'My Assignments')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <h1>My Assignments</h1>
        <a href="{{ route('lecturer.create-assignment') }}" class="btn btn-primary">Create New Assignment</a>
    </div>

    @if($assignments->count() > 0)
        <div class="assignments-grid">
            @foreach($assignments as $assignment)
                <div class="assignment-card">
                    <div class="assignment-card-header">
                        <h3>{{ $assignment->title }}</h3>
                        <span class="course-badge">{{ $assignment->course_code }}</span>
                    </div>
                    
                    <div class="assignment-card-body">
                        <p class="course-title">{{ $assignment->course_title }}</p>
                        <p class="description-preview">{{ Str::limit($assignment->description, 120) }}</p>
                        
                        <div class="assignment-stats">
                            <div class="stat-item">
                                <span class="stat-icon">📝</span>
                                <span class="stat-text">{{ $assignment->submissions_count }} Submissions</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-icon">📅</span>
                                <span class="stat-text">Due: {{ $assignment->due_date->format('M d, Y') }}</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-icon">💯</span>
                                <span class="stat-text">{{ $assignment->total_marks }} Marks</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="assignment-card-footer">
                        <span class="created-date">Created {{ $assignment->created_at->diffForHumans() }}</span>
                        <a href="{{ route('lecturer.assignment.show', ['id' => $assignment->id]) }}" class="btn btn-small">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination-wrapper">
            {{ $assignments->links() }}
        </div>
    @else
        <div class="empty-state-large">
            <div class="empty-icon">📚</div>
            <h2>No Assignments Yet</h2>
            <p>You haven't created any assignments. Start by creating your first assignment.</p>
            <a href="{{ route('lecturer.create-assignment') }}" class="btn btn-primary">Create Your First Assignment</a>
        </div>
    @endif
</div>
@endsection