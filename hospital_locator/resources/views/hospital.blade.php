<!-- resources/views/hospital.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    @vite('resources/css/hospital.css')
    <title>{{ $hospital->hospital_name }} - Hospital Details</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/hospital.css') }}"> --}}
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <span class="nav-icon">🏥</span>
                <span class="nav-title">Hospital Location System</span>
            </div>
            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link">
                    <span class="link-icon">🏠</span>
                    Home
                </a>
                <a href="{{ route('hospital_register') }}" class="nav-link">
                    <span class="link-icon">📝</span>
                    Hospital Registration
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="header">
            @if($hospital->logo_path)
                <img src="{{ asset('storage/' . $hospital->logo_path) }}" alt="{{ $hospital->hospital_name }}" class="logo">
            @else
                <div class="logo-placeholder">🏥</div>
            @endif
            <div class="header-info">
                <h1>{{ $hospital->hospital_name }}</h1>
                <p class="hospital-type">{{ $hospital->hospital_type }}</p>
            </div>
        </div>

        <div class="content-wrapper">
            <div class="details-section">
                <div class="section">
                    <h2>Registration Information</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="label">Registration No:</span>
                            <span class="value">{{ $hospital->reg_no }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">License Issue Date:</span>
                            <span class="value">{{ $hospital->lic_issue_dt ? date('F d, Y', strtotime($hospital->lic_issue_dt)) : 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Accreditation Status:</span>
                            <span class="value badge {{ strtolower($hospital->accred_status) }}">{{ $hospital->accred_status }}</span>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h2>Hospital Information</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="label">Medical Director:</span>
                            <span class="value">{{ $hospital->med_dir }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Ownership:</span>
                            <span class="value">{{ $hospital->ownership }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Number of Beds:</span>
                            <span class="value">{{ $hospital->beds }}</span>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h2>Contact Information</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="label">Email:</span>
                            <span class="value"><a href="mailto:{{ $hospital->email }}">{{ $hospital->email }}</a></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Contact Number:</span>
                            <span class="value"><a href="tel:{{ $hospital->contact_no }}">{{ $hospital->contact_no }}</a></span>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h2>Location</h2>
                    <div class="info-grid">
                        <div class="info-item full-width">
                            <span class="label">Address:</span>
                            <span class="value">{{ $hospital->address }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">City:</span>
                            <span class="value">{{ $hospital->city }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">State:</span>
                            <span class="value">{{ $hospital->state }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Country:</span>
                            <span class="value">{{ $hospital->country }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Coordinates:</span>
                            <span class="value">{{ $hospital->latitude }}, {{ $hospital->longitude }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="map-section">
                <h2>Location Map</h2>
                <div id="map"></div>
                <div class="map-info">
                    <p>📍 {{ $hospital->hospital_name }}</p>
                    <p class="small-text">{{ $hospital->address }}</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        let map;
        
        function initMap() {
            const hospitalLocation = {
                lat: parseFloat('{{ $hospital->latitude }}'),
                lng: parseFloat('{{ $hospital->longitude }}')
            };

            map = new google.maps.Map(document.getElementById('map'), {
                center: hospitalLocation,
                zoom: 15,
                mapTypeControl: true,
                streetViewControl: true,
                fullscreenControl: true
            });

            const marker = new google.maps.Marker({
                position: hospitalLocation,
                map: map,
                title: '{{ $hospital->hospital_name }}',
                animation: google.maps.Animation.DROP
            });

            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div style="padding: 10px; max-width: 250px;">
                        <h3 style="margin: 0 0 8px 0; color: #2c5aa0;">{{ $hospital->hospital_name }}</h3>
                        <p style="margin: 5px 0; font-size: 13px;"><strong>Type:</strong> {{ $hospital->hospital_type }}</p>
                        <p style="margin: 5px 0; font-size: 13px;"><strong>Contact:</strong> {{ $hospital->contact_no }}</p>
                        <p style="margin: 5px 0; font-size: 13px;">{{ $hospital->address }}</p>
                    </div>
                `
            });

            marker.addListener('click', function() {
                infoWindow.open(map, marker);
            });

            // Open info window by default
            infoWindow.open(map, marker);
        }
    </script>

    <!-- Replace YOUR_API_KEY with your actual Google Maps API key -->
    <script>
        window.API_KEY = @json(config('services.google_maps.api_key'));
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap" async defer></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script> --}}
    
</body>
</html>












