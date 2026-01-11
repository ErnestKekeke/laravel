@extends('layouts.default')

@section('page-name', 'Contact')

@section('main-content')
<a href="{{ route('home') }}">goto home</a><br/>
<a href="{{ route('about') }}">goto about</a>



{{-- using cookie without if statement --}}
<p>Age, {{ request()->cookie('age', 0) }}</p>
<p>Name, {{ request()->cookie('name', 'unkown') }}</p>


{{-- to check if a cookie exist --}}
@if (request()->hasCookie('name'))
    Hello, {{ request()->cookie('name') }}
@endif

<form method="POST" action="{{ route('contact') }}">
    @csrf
    <button type="submit">Send</button>
</form>
@endsection

@section('footer')
<h3><i>www.com</i></h3>
@endsection

