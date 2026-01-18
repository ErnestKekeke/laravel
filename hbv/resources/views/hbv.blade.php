<h2>We care about you !</h2>

{{-- Access logged-in clinic details --}}
@if(Auth::guard('clinic')->check())
    <p>Clinic Name: {{ Auth::guard('clinic')->user()->clinic_name }}</p>
    <p>Clinic ID: {{ Auth::guard('clinic')->user()->clinic_id }}</p>
    <p>Registration No: {{ Auth::guard('clinic')->user()->reg_no }}</p>


    <form method="GET" action="{{ route('clinic') }}">
        <button type="submit">See Clinic Details</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@else
    <p>No clinic is logged in.</p>
    <a href="{{route('clinic.login') }}">Login here</a>
@endif