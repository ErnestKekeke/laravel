@extends('layouts.default')

@section('page-name', 'About')

@section('main-content')
<p>Our Company is about</p>
<a href={{ route('home')}}>goto home</a><br/>
<a href="{{ route('contact') }}">goto contact</a>
@endsection

@section('footer')
<h3>Special footer for About page</h3>
@endsection