<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    <title>Hepatitis B Awareness & Testing</title>
    @vite('resources/css/reset.css')
    @vite('resources/css/home.css')
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <div class="logo">
                <img src="https://cdn-icons-png.flaticon.com/512/2913/2913133.png" alt="Liver Health" class="logo-img">
                <span>HepB Awareness</span>
            </div>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="#about">About HBV</a></li>
                <li><a href="#symptoms">Symptoms</a></li>
                <li><a href="#testing">Get Tested</a></li>
                <li><a href="#prevention">Prevention</a></li>
            </ul>

                    @auth('clinic')
                        <a href="{{ route('clinic') }}" class="btn btn-clinic">Clinic Details</a>
                    @else
                        <a href="{{ route('clinic.login') }}" class="btn btn-clinic">Clinic Login</a>
                    @endauth

        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Know Your Status. Protect Your Liver.</h1>
            <p>Hepatitis B is a serious liver infection that affects millions worldwide. Early detection saves lives. Get tested today.</p>
            <div class="hero-buttons">
                <a href="#testing" class="btn btn-primary btn-large">Find Testing Centers</a>
                <a href="#about" class="btn btn-secondary btn-large">Learn More</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800" alt="Medical Care">
        </div>
    </section>

    <!-- About HBV Section -->
    <section id="about" class="about">
        <div class="container">
            <h2 class="section-title">What is Hepatitis B?</h2>
            <div class="about-grid">
                <div class="about-content">
                    <p>Hepatitis B is a viral infection that attacks the liver and can cause both acute and chronic disease. The virus is transmitted through contact with the blood or other body fluids of an infected person.</p>
                    <p>Over 296 million people worldwide are living with chronic Hepatitis B infection, with more than 820,000 deaths annually due to complications like cirrhosis and liver cancer.</p>
                    <div class="info-box">
                        <h3>Key Facts</h3>
                        <ul>
                            <li>Hepatitis B is preventable with a safe and effective vaccine</li>
                            <li>Can be transmitted from mother to child during birth</li>
                            <li>Most adults recover fully, but children are at higher risk of chronic infection</li>
                            <li>Early detection and treatment can prevent serious complications</li>
                        </ul>
                    </div>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1631217868264-e5b90bb7e133?w=600" alt="Liver Illustration">
                </div>
            </div>
        </div>
    </section>

    <!-- Symptoms Section -->
    <section id="symptoms" class="symptoms">
        <div class="container">
            <h2 class="section-title">Recognize the Symptoms</h2>
            <p class="section-subtitle">Many people with Hepatitis B don't show symptoms. When they do appear, they may include:</p>
            <div class="symptoms-grid">
                <div class="symptom-card">
                    <div class="symptom-icon">🤒</div>
                    <h3>Fever</h3>
                    <p>Persistent low-grade or high fever</p>
                </div>
                <div class="symptom-card">
                    <div class="symptom-icon">😫</div>
                    <h3>Fatigue</h3>
                    <p>Extreme tiredness and weakness</p>
                </div>
                <div class="symptom-card">
                    <div class="symptom-icon">🤢</div>
                    <h3>Nausea</h3>
                    <p>Loss of appetite and vomiting</p>
                </div>
                <div class="symptom-card">
                    <div class="symptom-icon">🟡</div>
                    <h3>Jaundice</h3>
                    <p>Yellowing of skin and eyes</p>
                </div>
                <div class="symptom-card">
                    <div class="symptom-icon">💪</div>
                    <h3>Joint Pain</h3>
                    <p>Aching joints and muscles</p>
                </div>
                <div class="symptom-card">
                    <div class="symptom-icon">🤕</div>
                    <h3>Abdominal Pain</h3>
                    <p>Discomfort in the liver area</p>
                </div>
            </div>
            <div class="warning-box">
                <p><strong>Important:</strong> Many people have no symptoms, especially in early stages. Regular testing is crucial if you're at risk.</p>
            </div>
        </div>
    </section>

    <!-- Testing Section -->
    <section id="testing" class="testing">
        <div class="container">
            <h2 class="section-title">Get Tested Today</h2>
            <p class="section-subtitle">Early detection is key to managing Hepatitis B effectively</p>
            
            <div class="testing-grid">
                <div class="testing-card">
                    <img src="https://images.unsplash.com/photo-1666214280557-f1b5022eb634?w=400" alt="Blood Test">
                    <h3>Simple Blood Test</h3>
                    <p>A quick blood test can determine if you have Hepatitis B. The test looks for specific antigens and antibodies.</p>
                </div>
                <div class="testing-card">
                    <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=400" alt="Medical Consultation">
                    <h3>Free Consultation</h3>
                    <p>Many clinics offer free or low-cost testing. Speak with a healthcare provider about your risk factors.</p>
                </div>
                <div class="testing-card">
                    <img src="https://images.unsplash.com/photo-1584362917165-526a968579e8?w=400" alt="Results">
                    <h3>Quick Results</h3>
                    <p>Most tests provide results within a few days. Your clinic will guide you on next steps based on results.</p>
                </div>
            </div>

            <div class="who-should-test">
                <h3>Who Should Get Tested?</h3>
                <div class="risk-factors">
                    <div class="risk-item">✓ Healthcare workers exposed to blood</div>
                    <div class="risk-item">✓ People born in high-prevalence areas</div>
                    <div class="risk-item">✓ Infants born to infected mothers</div>
                    <div class="risk-item">✓ People with multiple sexual partners</div>
                    <div class="risk-item">✓ Injection drug users</div>
                    <div class="risk-item">✓ Household contacts of infected persons</div>
                </div>
            </div>

            <div class="cta-box">
                <h3>Ready to Get Tested?</h3>
                <p>Contact your nearest registered clinic to schedule a test</p>
                <a href="https://www.babatelehealth.com/" target="blank" class="btn btn-primary btn-large">Find Nearby Clinics</a>
            </div>
        </div>
    </section>

    <!-- Prevention Section -->
    <section id="prevention" class="prevention">
        <div class="container">
            <h2 class="section-title">Prevention & Protection</h2>
            <div class="prevention-grid">
                <div class="prevention-card">
                    <div class="prevention-icon">💉</div>
                    <h3>Get Vaccinated</h3>
                    <p>The Hepatitis B vaccine is safe, effective, and provides long-term protection. It's given in 3-4 doses over 6 months.</p>
                </div>
                <div class="prevention-card">
                    <div class="prevention-icon">🩺</div>
                    <h3>Safe Practices</h3>
                    <p>Use sterile medical equipment, practice safe sex, and avoid sharing personal items like razors or toothbrushes.</p>
                </div>
                <div class="prevention-card">
                    <div class="prevention-icon">👶</div>
                    <h3>Protect Newborns</h3>
                    <p>Babies born to infected mothers should receive vaccine and immunoglobulin within 12 hours of birth.</p>
                </div>
                <div class="prevention-card">
                    <div class="prevention-icon">🔬</div>
                    <h3>Screen Blood Products</h3>
                    <p>Ensure all blood transfusions and organ transplants are screened for Hepatitis B.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Clinic Section -->
    <section class="clinic-section">
        <div class="container">
            <div class="clinic-info">
                <h2>For Healthcare Providers</h2>
                <p>Are you a clinic or healthcare facility managing Hepatitis B patients? Access our secure portal to enter and track patient records, vaccination schedules, and treatment outcomes.</p>
                @auth('clinic')
                    <a href="{{ route('clinic') }}" class="btn btn-clinic-large">Clinic Details</a>
                @else
                    <a href="{{ route('clinic.login') }}" class="btn btn-clinic-large">Clinic Login Portal</a>
                @endauth
                <p class="register-link">New clinic? <a href="{{ route('clinic.register') }}">Register your facility</a></p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>HepB Awareness</h3>
                <p>Dedicated to raising awareness about Hepatitis B and connecting patients with quality care.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#about">About Hepatitis B</a></li>
                    <li><a href="#symptoms">Symptoms</a></li>
                    <li><a href="#testing">Get Tested</a></li>
                    <li><a href="#prevention">Prevention</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>For Clinics</h3>
                <ul>
                    <li><a href="{{ route('clinic.login') }}">Clinic Login</a></li>
                    <li><a href="{{ route('clinic.register') }}">Register Clinic</a></li>
                    <li><a href="{{ url('/clinic/help') }}">Help & Support</a></li>
                    <li><a href="{{ url('/clinic/resources') }}">Resources</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <ul>
                    <li><a href="mailto:info@hepbawareness.org">info@hepbawareness.org</a></li>
                    <li>Hotline: 1-800-HEP-TEST</li>
                    <li>Emergency: Available 24/7</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Hepatitis B Awareness Initiative. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>