<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    <title>Donate - Hope Foundation Nigeria</title>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">Hope Foundation</div>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('donate') }}" class="active">Donate</a></li>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            </ul>
        </div>
    </nav>

    <section class="donate-section">
        <div class="container">
            <h1>Make a Donation</h1>
            <p class="subtitle">Your generosity transforms lives. Choose a project and contribute today.</p>

            <div class="donate-container">
                <form action="{{ route('donate.process') }}" method="POST" class="donate-form">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required>
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone">
                        @error('phone')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="project_id">Select Project</label>
                        <select id="project_id" name="project_id" required>
                            <option value="">-- Choose a Project --</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->title }}</option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="amount">Donation Amount (₦)</label>
                        <input type="number" id="amount" name="amount" min="100" step="0.01" required>
                        @error('amount')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select id="payment_method" name="payment_method" required>
                            <option value="">-- Select Payment Method --</option>
                            <option value="card">Debit/Credit Card</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="ussd">USSD</option>
                        </select>
                        @error('payment_method')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="payment-note">
                        <p><strong>Note:</strong> This is a development system. No actual payment will be processed. For demonstration purposes only.</p>
                    </div>

                    <button type="submit" class="btn btn-primary btn-large">Complete Donation</button>
                </form>

                <div class="donation-info">
                    <h3>Why Donate?</h3>
                    <ul>
                        <li>100% of donations go directly to beneficiaries</li>
                        <li>Transparent tracking of all contributions</li>
                        <li>Regular updates on project progress</li>
                        <li>Tax-deductible receipts provided</li>
                    </ul>

                    <div class="trust-badges">
                        <p><strong>Secure & Trusted</strong></p>
                        <p>Your donation is safe with us. We maintain the highest standards of financial accountability and transparency.</p>
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