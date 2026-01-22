@extends('layouts.app')

@section('title', 'Assignment Details')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/assignment-detail.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <a href="{{ route('student.assignments') }}" class="back-link">← Back to Assignments</a>
        <h1>{{ $assignment->title }}</h1>
    </div>

    <div class="assignment-detail">
        <div class="detail-card">
            <div class="card-header">
                <h2>Assignment Information</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <span class="info-label">Course Code:</span>
                    <span class="info-value">{{ $assignment->course_code }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Course Title:</span>
                    <span class="info-value">{{ $assignment->course_title }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Lecturer:</span>
                    <span class="info-value">{{ $assignment->lecturer->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Total Marks:</span>
                    <span class="info-value">{{ $assignment->total_marks }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Due Date:</span>
                    <span class="info-value {{ $assignment->isOverdue() ? 'overdue' : '' }}">
                        {{ $assignment->due_date->format('M d, Y h:i A') }}
                        ({{ $assignment->due_date->diffForHumans() }})
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Posted:</span>
                    <span class="info-value">{{ $assignment->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        <div class="detail-card">
            <div class="card-header">
                <h2>Description</h2>
            </div>
            <div class="card-body">
                <p class="description-text">{{ $assignment->description }}</p>
            </div>
        </div>

        @if($submission)
            <div class="detail-card submission-card">
                <div class="card-header">
                    <h2>Your Submission</h2>
                    <span class="badge {{ $submission->getStatusBadgeClass() }}">{{ ucfirst($submission->status) }}</span>
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <span class="info-label">Submitted At:</span>
                        <span class="info-value">{{ $submission->submitted_at->format('M d, Y h:i A') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">File:</span>
                        <span class="info-value">{{ basename($submission->file_path) }}</span>
                    </div>
                    @if($submission->score)
                        <div class="info-row">
                            <span class="info-label">Score:</span>
                            <span class="info-value score-value">{{ $submission->score }}/{{ $assignment->total_marks }}</span>
                        </div>
                    @endif
                    @if($submission->feedback)
                        <div class="feedback-section">
                            <h4>Lecturer Feedback:</h4>
                            <p>{{ $submission->feedback }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="detail-card submit-card">
                <div class="card-header">
                    <h2>Submit Assignment</h2>
                </div>
                <div class="card-body">
                    @if($assignment->isOverdue())
                        <div class="alert alert-warning">
                            This assignment is overdue. Submissions will be marked as late.
                        </div>
                    @endif

                    <form action="{{ route('student.assignment.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="submit-form">
                        @csrf
                        <div class="form-group">
                            <label for="file">Upload File (PDF, DOC, DOCX, ZIP - Max 10MB)</label>
                            <input 
                                type="file" 
                                id="file" 
                                name="file" 
                                accept=".pdf,.doc,.docx,.zip" 
                                required
                            >
                            @error('file')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Assignment</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection