@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')

@if (Session::get('success'))
<div class="alert alert-success w-32 h-10">
    {{ Session::get('success') }}
</div>
@endif

<p>Selamat datang, {{ Auth::user()->name }}!</p>
<div class="alert alert-secondary" role="alert">
    <h3>Selamat datang Administrator</h3>

</div>

@endsection