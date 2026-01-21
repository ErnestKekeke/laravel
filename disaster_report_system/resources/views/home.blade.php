<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edo State Disaster Management System</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/home.css') }}"> --}}
    @vite('resources/css/home.css')
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Edo State Disaster Management System</h1>
            <p class="tagline">Report emergencies and disasters in real-time</p>
        </div>
    </header>

    <nav class="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="nav-link active">Home</a>
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin Dashboard</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <section class="hero">
                <h2>Report a Disaster or Emergency</h2>
                <p>Help us respond quickly by providing accurate information about disasters in your area</p>
            </section>

            <section class="report-form-section">
                <form action="{{ route('report.store') }}" method="POST" class="report-form">
                    @csrf
                    
                    <div class="form-group">
                        <label for="disaster_type_id">Disaster Type <span class="required">*</span></label>
                        <select name="disaster_type_id" id="disaster_type_id" required>
                            <option value="">Select disaster type</option>
                            @foreach($disasterTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('disaster_type_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="reporter_name">Your Name <span class="required">*</span></label>
                        <input type="text" name="reporter_name" id="reporter_name" value="{{ old('reporter_name') }}" required>
                        @error('reporter_name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="reporter_phone">Phone Number <span class="required">*</span></label>
                        <input type="tel" name="reporter_phone" id="reporter_phone" value="{{ old('reporter_phone') }}" required>
                        @error('reporter_phone')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="location">Location <span class="required">*</span></label>
                        <input type="text" name="location" id="location" placeholder="e.g., Benin City, GRA" value="{{ old('location') }}" required>
                        @error('location')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="severity">Severity Level <span class="required">*</span></label>
                        <select name="severity" id="severity" required>
                            <option value="">Select severity</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                            <option value="critical">Critical</option>
                        </select>
                        @error('severity')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description <span class="required">*</span></label>
                        <textarea name="description" id="description" rows="5" placeholder="Provide detailed information about the disaster..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">Submit Report</button>
                </form>
            </section>

            <section class="emergency-contacts">
                <h3>Emergency Contacts</h3>
                <div class="contact-grid">
                    <div class="contact-card">
                        <h4>Fire Service</h4>
                        <p>Phone: 112</p>
                    </div>
                    <div class="contact-card">
                        <h4>Police</h4>
                        <p>Phone: 112</p>
                    </div>
                    <div class="contact-card">
                        <h4>Ambulance</h4>
                        <p>Phone: 112</p>
                    </div>
                    <div class="contact-card">
                        <h4>NEMA Edo</h4>
                        <p>Phone: 0800-123-4567</p>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 Edo State Disaster Management System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>