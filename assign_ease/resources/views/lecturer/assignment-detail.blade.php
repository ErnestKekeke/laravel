@extends('layouts.app')

@section('title', 'Assignment Details')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/assignment-detail.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <a href="{{ route('lecturer.assignments') }}" class="back-link">← Back to My Assignments</a>
        <h1>{{ $assignment->title }}</h1>
    </div>

    <div class="assignment-detail">
        <div class="detail-card">
            <div class="card-header">
                <h2>Assignment Information</h2>
                <span class="submissions-badge">{{ $assignment->submissions_count }} Submissions</span>
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
                    <span class="info-label">Total Marks:</span>
                    <span class="info-value">{{ $assignment->total_marks }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Due Date:</span>
                    <span class="info-value {{ $assignment->isOverdue() ? 'overdue' : '' }}">
                        {{ $assignment->due_date->format('M d, Y h:i A') }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Created:</span>
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

        <div class="detail-card">
            <div class="card-header">
                <h2>Student Submissions ({{ $submissions->count() }})</h2>
            </div>
            <div class="card-body">
                @if($submissions->count() > 0)
                    <div class="submissions-table-wrapper">
                        <table class="submissions-table">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Matric Number</th>
                                    <th>Submitted At</th>
                                    <th>Status</th>
                                    <th>Score</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($submissions as $submission)
                                    <tr>
                                        <td><strong>{{ $submission->student->name }}</strong></td>
                                        <td>{{ $submission->student->matric_number }}</td>
                                        <td>{{ $submission->submitted_at->format('M d, Y h:i A') }}</td>
                                        <td>
                                            <span class="badge {{ $submission->getStatusBadgeClass() }}">
                                                {{ ucfirst($submission->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($submission->score)
                                                <span class="score-display">{{ $submission->score }}/{{ $assignment->total_marks }}</span>
                                            @else
                                                <span class="text-muted">Not graded</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('lecturer.submission.download', $submission->id) }}" 
                                                   class="btn btn-small btn-download" 
                                                   title="Download Submission">
                                                    Download
                                                </a>
                                                <button class="btn btn-small btn-grade" 
                                                        onclick="openGradeModal({{ $submission->id }}, '{{ $submission->student->name }}', {{ $submission->score ?? 'null' }}, '{{ addslashes($submission->feedback ?? '') }}')">
                                                    Grade
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <p>No submissions yet for this assignment.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Grading Modal -->
<div id="gradeModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Grade Submission</h3>
            <span class="close" onclick="closeGradeModal()">&times;</span>
        </div>
        <form id="gradeForm" method="POST" action="">
            @csrf
            <div class="modal-body">
                <p><strong>Student:</strong> <span id="studentName"></span></p>
                
                <div class="form-group">
                    <label for="score">Score (out of {{ $assignment->total_marks }})</label>
                    <input type="number" 
                           id="score" 
                           name="score" 
                           min="0" 
                           max="{{ $assignment->total_marks }}" 
                           required>
                </div>

                <div class="form-group">
                    <label for="feedback">Feedback (Optional)</label>
                    <textarea id="feedback" 
                              name="feedback" 
                              rows="5" 
                              placeholder="Provide feedback to the student..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeGradeModal()">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit Grade</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/grading.js') }}"></script>
@endsection