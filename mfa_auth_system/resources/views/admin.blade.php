<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    @vite('resources/css/reset.css')
    @vite('resources/css/admin.css')
</head>
<body>

            {{-- Restore users from session if redirected --}}
    @php
        $users = $users ?? session('admin_users');
    @endphp

    @if(session('success'))
        <p style="color: green"> {{ session('success') }} </p> 
    @elseif(session('info'))
        <p style="color: blue">{{ session('info') }}</p>
    @elseif(session('error'))
        <p style="color: red">{{ session('error') }}</p>
    @endif


@empty($users)
    <form action="{{ route('admin.allusers') }}" method="POST">
        @csrf
        <input type="text" name="adminkey" />
        <button type="submit">Enter Admin Code</button>
    </form>
@endempty


@isset($users)
    @error('password') <span style="color:red;">{{ $message }}</span> @enderror
    @foreach($users as $user)
        <div style="margin-bottom: 20px;">
            <p>
                username: <b>{{ $user->name }}</b>, 
                email: <b>{{ $user->email }}</b>, 
                userID: <b>{{ $user->userid }}</b>, 
                Phone No: <b>{{ $user->phone }}</b>, 
                company: <b>{{ ucfirst($user->company) }}</b>
            </p>

            <form action="{{ route('admin.changepassword', $user->email) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="password" name="password" placeholder="Change password" required />
                <button type="submit">Change Password</button>
            </form>

            <form action="{{ route('admin.delete', $user->email) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete User: {{ $user->userid }}</button>
            </form>
        </div>
    @endforeach

    <form action="{{ route('admin.close', $user->email) }}" method="POST">
        @csrf
        <button type="submit">Close</button>
    </form>
@endisset

</body>
</html>