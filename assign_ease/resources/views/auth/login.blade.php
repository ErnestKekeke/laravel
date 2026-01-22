@extends('layouts.app')

@section('title', 'Login - Assignment Management System')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Welcome Back</h2>
            <p>Login to access your dashboard</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    placeholder="your.email@university.edu.ng"
                >
                @error('email')
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
                    placeholder="Enter your password"
                >
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group checkbox-group">
                <label>
                    <input type="checkbox" name="remember">
                    <span>Remember Me</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-full">Login</button>
        </form>

        <div class="auth-footer">
            <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </div>

        <div class="demo-credentials">
            <h4>Demo Credentials:</h4>
            <p><strong>Lecturer:</strong> adeyemi.ogunleye@university.edu.ng / password</p>
            <p><strong>Student:</strong> chidinma.nwosu@student.edu.ng / password</p>
        </div>
    </div>
</div>
@endsection