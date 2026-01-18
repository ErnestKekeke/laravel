<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    @vite('resources/css/reset.css')
    @vite('resources/css/clinic.css')
    <title>Clinic Profile</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/clinic-profile.css') }}"> --}}
</head>
<body>

    @if(session('success'))
        <p style="color: green"> {{ session('success') }} </p> 
    @elseif(session('info'))
        <p style="color: blue">{{ session('info') }}</p>
    @elseif(session('error'))
        <p style="color: red">{{ session('error') }}</p>
    @endif

@auth('clinic')  

    @php
        $clinic = Auth::guard('clinic')->user();
    @endphp

    @if(Auth::guard('clinic')->check())
        <div class="clinic-container">
            <div class="clinic-card">
                <!-- Header Section -->
                <div class="clinic-header">
                    <div class="logo-section">
                        @if($clinic->clinic_id)
                            {{-- <img src="{{ asset('storage/' . $clinic->logo) }}" alt="Clinic Logo" class="clinic-logo"> --}}
                            {{-- <img src="{{ asset('storage/' . $clinic->logo) }}" alt="Clinic Logo" class="clinic-logo"> --}}
                            <img style="max-width:100px;" src="{{ asset('storage/' . 'logos/' . $clinic->clinic_id . '.png') }}" alt="Clinic Logo">
                        @else
                            <div class="logo-placeholder">
                                <span>{{ strtoupper(substr($clinic->clinic_name, 0, 2)) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="clinic-title">
                        <h1>{{ $clinic->clinic_name }}</h1>
                        <span class="clinic-type-badge">{{ $clinic->clinic_type }}</span>
                    </div>
                </div>

                <!-- Main Information Grid -->
                <div class="info-grid">
                    <!-- Registration Details -->
                    <div class="info-section">
                        <h2 class="section-title">Registration Details</h2>
                        <div class="info-group">
                            <div class="info-item">
                                <label>Clinic ID</label>
                                <p>{{ $clinic->clinic_id }}</p>
                            </div>
                            <div class="info-item">
                                <label>Registration Number</label>
                                <p>{{ $clinic->reg_no }}</p>
                            </div>
                            <div class="info-item">
                                <label>License Issue Date</label>
                                <p>{{ $clinic->lic_issue_dt ? \Carbon\Carbon::parse($clinic->lic_issue_dt)->format('d M Y') : 'N/A' }}</p>
                            </div>
                            <div class="info-item">
                                <label>Accreditation Status</label>
                                <p>
                                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $clinic->accred_status ?? 'pending')) }}">
                                        {{ $clinic->accred_status ?? 'Pending' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Medical Director -->
                    <div class="info-section">
                        <h2 class="section-title">Medical Director</h2>
                        <div class="info-group">
                            <div class="info-item full-width">
                                <label>Name</label>
                                <p>{{ $clinic->med_dir ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="info-section">
                        <h2 class="section-title">Contact Information</h2>
                        <div class="info-group">
                            <div class="info-item">
                                <label>Email</label>
                                <p><a href="mailto:{{ $clinic->email }}">{{ $clinic->email }}</a></p>
                            </div>
                            <div class="info-item">
                                <label>Contact Number</label>
                                <p><a href="tel:{{ $clinic->contact_no }}">{{ $clinic->contact_no ?? 'N/A' }}</a></p>
                            </div>
                            <div class="info-item full-width">
                                <label>Address</label>
                                <p>{{ $clinic->address ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Location Details -->
                    <div class="info-section">
                        <h2 class="section-title">Location</h2>
                        <div class="info-group">
                            <div class="info-item">
                                <label>City</label>
                                <p>{{ $clinic->city ?? 'N/A' }}</p>
                            </div>
                            <div class="info-item">
                                <label>State</label>
                                <p>{{ $clinic->state ?? 'N/A' }}</p>
                            </div>
                            <div class="info-item">
                                <label>Country</label>
                                <p>{{ $clinic->country ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    {{-- <a href="{{ route('clinic.edit') }}" class="btn btn-primary">Edit Profile</a> --}}
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>

                    <form method="GET" action="{{ route('hbv') }}" style="display: inline;">
                        <button type="submit" class="btn btn-good">HBV</button>
                    </form>

                    <form action="{{ route('clinic.patient') }}" style="display: inline;">
                        <button type="submit" class="btn btn-good">New Patient</button>
                    </form>



                </div>
            </div>
         <a href="{{route('home') }}">goto home</a>    
        </div>
    @else
        <div class="clinic-container">
            <div class="clinic-card">
                <div class="not-logged-in">
                    <h2>No clinic is logged in.</h2>
                    <p>Please login to view your clinic profile.</p>
                    <a href="{{ route('clinic.login') }}" class="btn btn-primary">Login here</a>
                </div>
            </div>
        </div>
    @endif

            
      
@else
    <p> You are not login </p>
    <a href="{{ route('clinic.login') }}">Clinic Login</a> <br/>
     <a href="{{route('home') }}">goto home</a>
@endauth  


</body>
</html>