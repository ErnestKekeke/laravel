<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Edo State Disaster Management</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Admin Dashboard</h1>
            <p class="tagline">Manage and respond to disaster reports</p>
        </div>
    </header>

    <nav class="navbar">
        <div class="container navbar-content">
            <div class="nav-left">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('admin.dashboard') }}" class="nav-link active">Admin Dashboard</a>
            </div>
            <div class="nav-right">
                @auth
                    <span class="user-welcome">{{ Auth::user()->name }} (Admin)</span>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link logout-btn">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <section class="statistics">
                <div class="stat-card">
                    <h3>Total Reports</h3>
                    <p class="stat-number">{{ $totalReports }}</p>
                </div>
                <div class="stat-card pending">
                    <h3>Pending</h3>
                    <p class="stat-number">{{ $pendingReports }}</p>
                </div>
                <div class="stat-card resolved">
                    <h3>Resolved</h3>
                    <p class="stat-number">{{ $resolvedReports }}</p>
                </div>
                <div class="stat-card critical">
                    <h3>Critical</h3>
                    <p class="stat-number">{{ $criticalReports }}</p>
                </div>
            </section>

            <section class="reports-section">
                <h2>All Disaster Reports</h2>
                
                @if($reports->count() > 0)
                    <div class="table-container">
                        <table class="reports-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Reporter</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>Severity</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{ $report->id }}</td>
                                        <td>{{ $report->disasterType->name }}</td>
                                        <td>{{ $report->reporter_name }}</td>
                                        <td>{{ $report->reporter_phone }}</td>
                                        <td>{{ $report->location }}</td>
                                        <td>
                                            <span class="badge severity-{{ $report->severity }}">
                                                {{ ucfirst($report->severity) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge status-{{ $report->status }}">
                                                {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                                            </span>
                                        </td>
                                        <td>{{ $report->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <form action="{{ route('admin.update.status', $report->id) }}" method="POST" class="status-form">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()" class="status-select">
                                                    <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="in_progress" {{ $report->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="resolved" {{ $report->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="description-row">
                                        <td colspan="9">
                                            <strong>Description:</strong> {{ $report->description }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="no-reports">No disaster reports found.</p>
                @endif
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