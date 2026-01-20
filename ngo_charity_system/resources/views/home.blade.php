<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    <title>Hope Foundation Nigeria - Making a Difference</title>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">Hope Foundation</div>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}" class="active">Home</a></li>
                <li><a href="{{ route('donate') }}">Donate</a></li>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            </ul>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Transforming Lives Together</h1>
                <p>Join us in making a lasting impact on communities across Nigeria through education, healthcare, and poverty alleviation</p>
                <a href="{{ route('donate') }}" class="btn btn-primary">Make a Donation</a>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>₦{{ number_format($totalDonations, 2) }}</h3>
                    <p>Total Raised</p>
                </div>
                <div class="stat-card">
                    <h3>{{ $totalBeneficiaries }}</h3>
                    <p>Lives Impacted</p>
                </div>
                <div class="stat-card">
                    <h3>{{ count($projects) }}</h3>
                    <p>Active Projects</p>
                </div>
            </div>
        </div>
    </section>

    <section class="projects">
        <div class="container">
            <h2>Our Current Projects</h2>
            <div class="project-grid">
                @foreach($projects as $project)
                    <div class="project-card">
                        <h3>{{ $project->title }}</h3>
                        <p>{{ $project->description }}</p>
                        <div class="progress-bar">
                            <div class="progress" style="width: {{ ($project->raised_amount / $project->target_amount) * 100 }}%"></div>
                        </div>
                        <div class="project-meta">
                            <span>₦{{ number_format($project->raised_amount, 2) }}</span>
                            <span>of ₦{{ number_format($project->target_amount, 2) }}</span>
                        </div>
                        <a href="{{ route('donate') }}" class="btn btn-secondary">Support This Project</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mission">
        <div class="container">
            <h2>Our Mission</h2>
            <p>Hope Foundation is committed to empowering underserved communities in Nigeria by providing access to quality education, healthcare, and economic opportunities. Through transparency and accountability, we ensure every donation makes a real difference.</p>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Hope Foundation Nigeria. All rights reserved.</p>
            <p>Building hope, one community at a time.</p>
        </div>
    </footer>
</body>
</html>