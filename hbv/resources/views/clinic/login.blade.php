<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    @vite('resources/css/reset.css')
    @vite('resources/css/clinic/login.css')
</head>
<body>
    @if(session('success'))
        <p style="color: green"> {{ session('success') }} </p> 
    @elseif(session('info'))
        <p style="color: blue">{{ session('info') }}</p>
    @elseif(session('error'))
        <p style="color: red">{{ session('error') }}</p>
    @endif

    <h2>Clinic Login</h2>

    <form method="POST" action="{{ route('clinic.login') }}">
        @csrf

        <div>
            <label for="clinic_id">Clinic ID</label><br>
            <input type="text" name="clinic_id" id="clinic_id" value="{{ old('clinic_id') }}" required/>
            @error('clinic_id')<span>{{ $message }}</span>@enderror
        </div>

        <br>

        <div>
            <label for="reg_no">Registration Number</label><br>
            <input type="text" name="reg_no" id="reg_no" value="{{ old('reg_no') }}" required/>
            @error('reg_no')<span>{{ $message }}</span>@enderror
        </div>

        <br>

        <div>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" required/>
            @error('password')<span>{{ $message }}</span>@enderror
        </div>

        <br>

        <button type="submit">Login</button>

    </form>

    <div>
        <a href="{{route('clinic.register') }}">Register here</a> </br/>
         <a href="{{route('home') }}">goto home</a>
    </div>

  @vite('resources/js/clinic/login.js')
</body>
</html>
