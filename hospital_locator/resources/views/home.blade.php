<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    @vite('resources/css/home.css')
    <title>HOSPITAL LOCATION SYSTEM</title>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <span class="nav-icon">🏥</span>
                <span class="nav-title">Hospital Location System</span>
            </div>
            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link active">
                    <span class="link-icon">🏠</span>
                    Home
                </a>
                <a href="{{ route('hospital_register') }}" class="nav-link">
                    <span class="link-icon">📝</span>
                    Register Hospital
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Hospital Location System</h1>
            <p class="hero-subtitle">Quickly find nearby hospitals, view details, and make informed healthcare decisions.</p>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Hospitals</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Availability</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">100%</span>
                    <span class="stat-label">Verified</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Key Features Section -->
    <section class="features">
        <div class="container">
            <h2 class="section-title">Why Choose Our System?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📍</div>
                    <h3 class="feature-title">Locate Hospitals</h3>
                    <p class="feature-description">Search and view hospitals on an interactive map in real time with accurate location data.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🏥</div>
                    <h3 class="feature-title">Hospital Details</h3>
                    <p class="feature-description">Access accreditation status, address, contact information, and available services.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📝</div>
                    <h3 class="feature-title">Easy Registration</h3>
                    <p class="feature-description">Hospitals can register and manage their information easily through our platform.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <h2 class="section-title">Find a Hospital Near You</h2>
            <p class="section-subtitle">Explore hospitals on the interactive map below</p>
        </div>
    </section>

    <!-- Search & Map Side by Side Section -->
    <section class="search-section">
        <div class="container">
            <div id="map" class="map-container"></div>
            
            <div class="search-card">
                <h2 class="search-title">Search Hospital Details</h2>
                <p class="search-subtitle">Find a trusted hospital and discover more details</p>

                <form action="{{ route('hospital') }}" method="GET" class="search-form">
                    <div class="form-group">
                        <label for="find-hospital">Select Hospital</label>
                        <select id="find-hospital" name="find-hospital" class="form-select">
                            <option value="">-- Find Hospital --</option>
                        </select>
                        <input type="hidden" name="hospital-id" id="hospital-id">
                        @error('hospital-id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="hospital-preview">
                        <div class="preview-header">
                            <img id="logo" class="preview-logo" src="{{ asset('images/default_logo.png') }}" alt="Hospital Logo"/>
                            <div class="preview-info">
                                <h3 id="hospital-name" class="preview-name">Select a hospital</h3>
                                {{-- <span id="accreditation" class="preview-badge">Not selected</span> --}}
                            </div>
                        </div>
                        
                        <address id="address" class="preview-address">
                            <div class="address-line">
                                <span class="address-icon">📍</span>
                                <span>NIL, NIL</span>
                            </div>
                            <div class="address-line">
                                <span class="address-icon">✉️</span>
                                <a href="">NIL</a>
                            </div>
                            <div class="address-line">
                                <span class="address-icon">📞</span>
                                <a href="">NIL</a>
                            </div>
                        </address>
                    </div>

                    <button type="submit" id="btn-form-submit" class="submit-btn" disabled>
                        <span class="btn-icon">🔍</span>
                        View Full Details
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Call To Action -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-card">
                <div class="cta-content">
                    <h3 class="cta-title">Are you a healthcare provider?</h3>
                    <p class="cta-description">Register your hospital to reach more patients and improve accessibility.</p>
                </div>
                <a href="{{ route('hospital_register') }}" class="cta-btn">
                    <span class="btn-icon">➕</span>
                    Register Hospital Here!
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <span class="footer-icon">🏥</span>
                    <span class="footer-title">Hospital Location System</span>
                </div>
                <div class="footer-links">
                    <a href="#">About</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Contact</a>
                </div>
                <p class="footer-copyright">&copy; {{ date('Y') }} Hospital Location System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Script to pass DATA -->
    <script>
        window.APP_URL = @json(config('app.url'));
        window.API_KEY = @json(config('services.google_maps.api_key'));
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap" async defer></script>
    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>