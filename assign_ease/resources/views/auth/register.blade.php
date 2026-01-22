@extends('layouts.app')

@section('title', 'Register - Assignment Management System')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Create Account</h2>
            <p>Register to get started</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="auth-form" id="registerForm">
            @csrf

            <div class="form-group">
                <label for="name">Full Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required
                    placeholder="Enter your full name"
                >
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required
                    placeholder="your.email@university.edu.ng"
                >
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Register As</label>
                <select id="role" name="role" required>
                    <option value="">Select Role</option>
                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="lecturer" {{ old('role') == 'lecturer' ? 'selected' : '' }}>Lecturer</option>
                </select>
                @error('role')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" id="matricField" style="display: none;">
                <label for="matric_number">Matric Number</label>
                <input 
                    type="text" 
                    id="matric_number" 
                    name="matric_number" 
                    value="{{ old('matric_number') }}"
                    placeholder="e.g., CSC/2020/001"
                >
                @error('matric_number')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" id="staffField" style="display: none;">
                <label for="staff_id">Staff ID</label>
                <input 
                    type="text" 
                    id="staff_id" 
                    name="staff_id" 
                    value="{{ old('staff_id') }}"
                    placeholder="e.g., STAFF001"
                >
                @error('staff_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="department">Department</label>
                <input 
                    type="text" 
                    id="department" 
                    name="department" 
                    value="{{ old('department') }}" 
                    required
                    placeholder="e.g., Computer Science"
                >
                @error('department')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required
                    placeholder="Minimum 8 characters"
                >
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    required
                    placeholder="Re-enter your password"
                >
            </div>

            <button type="submit" class="btn btn-primary btn-full">Register</button>
        </form>

        <div class="auth-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/register.js') }}"></script>
@endsection