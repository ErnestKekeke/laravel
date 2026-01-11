<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    @vite('resources/css/reset.css')
    @vite('resources/css/register.css')
</head>
<body>
    <header>

    </header>

    <main>

        @auth
            <p> {{ auth()->user()->name}} You are login</p>
            <a href=" {{ route('home') }}">goto home</a>
        @else
            @if(session('email'))
                <p>{{ session('otp_state') ? "Code sent already is still active" : '' }}</p>
                {{-- <p>email, {{ session('email')}}</p> --}}
                <form action="{{ route('register.create') }}" method="POST">
                    @csrf
                    Enter Code Sent To Email: <input type="text" name="otpconfirm" placeholder="Enter Code">
                    <button>Enter</button>
                </form>

            @else
                {{-- <p>email not yet ! from session</p> --}}
                            {{-- registraion start line.............................  --}}
                <h3>Register here </h3>
                    @if(request()->has('error'))
                        <div style="color: red">
                            {{ ucfirst(str_replace('_', ' ', request()->get('error'))) }}
                        </div>
                    @endif

                    <form id="register-form" action="{{ route('register.user') }}" method="POST">
                        @csrf
                        <label for="firstname">Firstname</label><br>
                        <input type="text" name="firstname" value="{{ old('firstname') }}">
                        @error('firstname')<span>{{ $message }}</span>@enderror <br><br>

                        <label>Lastname</label><br>
                        <input type="text" name="lastname" value="{{ old('lastname') }}">
                        @error('lastname')<span>{{ $message }}</span>@enderror <br><br>

                        <label>Phone no</label><br>
                        <input type="tel" name="phone" value="{{ old('phone') }}">
                        @error('phone')<span>{{ $message }}</span>@enderror <br><br>

                        <label>Email</label><br>
                        <input type="email" name="email" value="{{ old('email') }}">
                        @error('email')<span>{{ $message }}</span>@enderror <br><br>

                        <label>User ID</label><br>
                        <input type="text" name="userid" value="{{ old('userid') }}">
                        @error('userid') <span>{{ $message }}</span>@enderror <br><br>
                        
                    <label>Company</label><br>
                    <select id="company" name="company">
                        <option value="andela" @selected(old('company') == 'andela')>Andela</option>
                        <option value="glo" @selected(old('company') == 'glo')>Glo</option>
                        <option value="jumia" @selected(old('company') == 'jumia')>Jumia</option>
                        <option value="kobo360" @selected(old('company') == 'kobo360')>Kobo360</option>
                        <option value="terragon" @selected(old('company') == 'terragon')>Terragon</option>
                    </select>

                        @error('company') <span>{{ $message }}</span>@enderror <br><br>


                        <label>Password</label><br>
                        <input id="pwd" type="password" name="password">
                        @error('password') <span>{{ $message }}</span> @enderror <br><br>

                        <label>Confirm Password</label> <span id="pdnm">password do not match</span><br>
                        <input id="com-pwd" type="password" name="password_confirmation">
                        @error('password_confirmation') <span>{{ $message }}</span> @enderror <br><br>

                        <input id="chk-agree" type="checkbox" name="agree" {{ old('agree') ? 'checked' : '' }}>
                        <label>I agree to the Terms and Conditions</label><br>
                        @error('agree')<span>{{ $message }}</span> @enderror <br>

                        <button type="submit">Register</button>
                    </form><br>
                {{-- registraion line ends .............................  --}}  
            @endif

            <div>
                Already have an account? <a href="{{ route('home') }}">Login here</a>
            </div>
        @endauth
    </main>
    
    @vite('resources/js/register.js')
</body>
</html>