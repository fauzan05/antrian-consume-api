@extends('layouts.app')

@section('title', 'Login User')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush
@section('content')
    <div class="container mt-5">
        <div class="row align-items-center justify-content-center">
            <div class="col-7 text-center">
                <h2 style="font-weight: 5000">Selamat Datang Di Halaman Login</h2>
                <p>Silahkan masukkan username dan password dengan benar</p>
                <img src="{{ asset('storage/img/login.jpg') }}" class="img-fluid" alt="">
            </div>
            @livewire('login')
        </div>
    </div>
@endsection
