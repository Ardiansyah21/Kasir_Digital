@extends('layoutsp.app')

@section('title', 'Dashboard')

@section('contents')

@if (Session::get('ssuccess'))
<div class="alert alert-success w-32 h-10">
    {{ Session::get('ssuccess') }}
</div>
@endif
<p>Selamat datang, {{ Auth::user()->name }}!</p>
<div class="alert alert-secondary" role="alert">
    <h3>Selamat datang Petugas</h3>

</div>

@endsection