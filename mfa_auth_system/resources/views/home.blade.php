<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    @vite('resources/css/reset.css')
    @vite('resources/css/home.css')
</head>
<body>
    @if(session('success'))
        <p style="color: green"> {{ session('success') }} </p> 
    @elseif(session('info'))
        <p style="color: blue">{{ session('info') }}</p>
    @elseif(session('error'))
        <p style="color: red">{{ session('error') }}</p>
    @endif

    <h3>GLORIA MFA AUTH</h3>

    <main>

        @auth
            <p> {{ auth()->user()->name}} You are login</p>

            <form action=" {{ route('login.company') }} " method="POST">
                @csrf
                <button type="submit">goto {{ ucfirst(auth()->user()->company)}}</button>
            </form>
            <!-- logout button -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <h2>Login</h2>
            @if(session('email'))
                <p>{{ session('otp_state') ? "Code sent already is still active" : '' }}</p>
                {{-- <p>email, {{ session('email')}}</p> --}}
                <form action="{{ route('login.login') }}" method="POST">
                    @csrf
                    Enter Code Sent To Email: <input type="text" name="otpconfirm" placeholder="Enter Code">
                    <button>Enter</button>
                </form>

            @else

                <form class="login-box" action=" {{ route('login.prelogin') }} " method="post">
                    @csrf
                    <label for="user_id_email">User Id or Email</label>
                    <input type="text" id="user_id_email" name="user_id_email" required>
                    @error('user_id_email')<span>{{ $message }}</span>@enderror <br>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')<span>{{ $message }}</span>@enderror <br>

                    <button type="submit">Log In</button>
                </form>

            @endif

            <div>
                <p>don't have an account <a href="{{ route('register') }}">Register</a> </p>
            </div>
        @endauth
    </main>

    @vite('resources/js/home.js')
</body>
</html>