<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    <title>Dashboard - Hope Foundation Nigeria</title>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">Hope Foundation</div>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('donate') }}">Donate</a></li>
                <li><a href="{{ route('dashboard') }}" class="active">Dashboard</a></li>
            </ul>
        </div>
    </nav>

    <section class="dashboard-section">
        <div class="container">
            <h1>Management Dashboard</h1>
            <p class="subtitle">Real-time overview of donations, projects, and impact</p>

            <div class="dashboard-stats">
                <div class="dash-card">
                    <h3>Total Donors</h3>
                    <p class="dash-number">{{ $totalDonors }}</p>
                </div>
                <div class="dash-card">
                    <h3>Total Donations</h3>
                    <p class="dash-number">₦{{ number_format($totalDonations, 2) }}</p>
                </div>
                <div class="dash-card">
                    <h3>Beneficiaries</h3>
                    <p class="dash-number">{{ $totalBeneficiaries }}</p>
                </div>
                <div class="dash-card">
                    <h3>Active Projects</h3>
                    <p class="dash-number">{{ count($projects) }}</p>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="dashboard-section-block">
                    <h2>Recent Donations</h2>
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Donor</th>
                                    <th>Project</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentDonations as $donation)
                                    <tr>
                                        <td>{{ $donation->donor_name }}</td>
                                        <td>{{ $donation->project_name }}</td>
                                        <td>₦{{ number_format($donation->amount, 2) }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $donation->payment_method)) }}</td>
                                        <td>{{ date('d M Y', strtotime($donation->created_at)) }}</td>
                                        <td><span class="status-badge status-{{ $donation->status }}">{{ ucfirst($donation->status) }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No donations yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="dashboard-section-block">
                    <h2>Project Progress</h2>
                    <div class="project-progress-list">
                        @foreach($projects as $project)
                            <div class="progress-item">
                                <div class="progress-header">
                                    <h4>{{ $project->title }}</h4>
                                    <span>{{ number_format(($project->raised_amount / $project->target_amount) * 100, 1) }}%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress" style="width: {{ ($project->raised_amount / $project->target_amount) * 100 }}%"></div>
                                </div>
                                <div class="progress-meta">
                                    <span>₦{{ number_format($project->raised_amount, 2) }}</span>
                                    <span>₦{{ number_format($project->target_amount, 2) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
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