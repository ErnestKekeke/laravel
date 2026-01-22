@extends('layouts.app')

@section('title', 'My Submissions')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <h1>My Submissions</h1>
    </div>

    @if($submissions->count() > 0)
        <div class="submissions-table">
            <table>
                <thead>
                    <tr>
                        <th>Assignment</th>
                        <th>Course</th>
                        <th>Submitted</th>
                        <th>Status</th>
                        <th>Score</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                        <tr>
                            <td>
                                <strong>{{ $submission->assignment->title }}</strong>
                            </td>
                            <td>{{ $submission->assignment->course_code }}</td>
                            <td>{{ $submission->submitted_at->format('M d, Y h:i A') }}</td>
                            <td>
                                <span class="badge {{ $submission->getStatusBadgeClass() }}">
                                    {{ ucfirst($submission->status) }}
                                </span>
                            </td>
                            <td>
                                @if($submission->score)
                                    <span class="score-display">{{ $submission->score }}/{{ $submission->assignment->total_marks }}</span>
                                @else
                                    <span class="text-muted">Not graded</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('student.assignment.show', $submission->assignment_id) }}" class="btn btn-small">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $submissions->links() }}
        </div>
    @else
        <div class="empty-state-large">
            <div class="empty-icon">📄</div>
            <h2>No Submissions Yet</h2>
            <p>You haven't submitted any assignments yet. Visit the assignments page to get started.</p>
            <a href="{{ route('student.assignments') }}" class="btn btn-primary">View Assignments</a>
        </div>
    @endif
</div>
@endsection