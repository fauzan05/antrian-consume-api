@extends('layouts.app')

@section('title', 'Unprocessable User')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush
@section('content')
    <div class="d-flex flex-column gap-4 text-center justify-content-center align-items-center" style="height: 100vh">
        <h3>your account haven't yet registered into counters</h3>
        <a href="{{ url('login') }}" type="button" class="btn btn-primary">Masuk dengan akun lain</a>
    </div>
@endsection