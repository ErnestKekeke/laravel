@extends('layouts.app')

@section('title', 'Create Assignment')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <a href="{{ route('lecturer.assignments') }}" class="back-link">← Back to Assignments</a>
        <h1>Create New Assignment</h1>
    </div>

    <div class="form-container">
        <form action="{{ route('lecturer.assignment.store') }}" method="POST" enctype="multipart/form-data" class="main-form">
            @csrf

            <div class="form-section">
                <h3>Assignment Details</h3>

                <div class="form-group">
                    <label for="title">Assignment Title *</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title') }}" 
                        required
                        placeholder="Enter assignment title"
                    >
                    @error('title')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description *</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="6" 
                        required
                        placeholder="Provide detailed instructions for the assignment"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-section">
                <h3>Course Information</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label for="course_code">Course Code *</label>
                        <input 
                            type="text" 
                            id="course_code" 
                            name="course_code" 
                            value="{{ old('course_code') }}" 
                            required
                            placeholder="e.g., CSC 301"
                        >
                        @error('course_code')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="course_title">Course Title *</label>
                        <input 
                            type="text" 
                            id="course_title" 
                            name="course_title" 
                            value="{{ old('course_title') }}" 
                            required
                            placeholder="e.g., Database Management Systems"
                        >
                        @error('course_title')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3>Submission Details</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label for="due_date">Due Date & Time *</label>
                        <input 
                            type="datetime-local" 
                            id="due_date" 
                            name="due_date" 
                            value="{{ old('due_date') }}" 
                            required
                            min="{{ now()->format('Y-m-d\TH:i') }}"
                        >
                        @error('due_date')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_marks">Total Marks *</label>
                        <input 
                            type="number" 
                            id="total_marks" 
                            name="total_marks" 
                            value="{{ old('total_marks', 100) }}" 
                            required
                            min="1"
                            max="100"
                        >
                        @error('total_marks')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="file">Attach File (Optional - PDF, DOC, DOCX - Max 5MB)</label>
                    <input 
                        type="file" 
                        id="file" 
                        name="file" 
                        accept=".pdf,.doc,.docx"
                    >
                    <small class="form-help">You can attach assignment instructions or reference materials</small>
                    @error('file')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create Assignment</button>
                <a href="{{ route('lecturer.assignments') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection