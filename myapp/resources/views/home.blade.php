@extends('layouts.default')

@section('page-name', 'Home')

@section('main-content')

<a href="{{ route('about') }}">goto about</a><br/>
<a href="{{ route('contact') }}">goto contact</a><br/>
<a href="{{ route('register') }}">Register</a>

<form action="{{ route('send-mail') }}" method="POST">
    @csrf
    username: <input type="text" name="username" required/><br/>
    message: <input type="text" name="msg" required/><br/>
    <button type="submit">send email</button>
</form>


@endsection

@section('footer')
<h3>Special footer for home page</h3>
@endsection
