@extends('layouts.app')
@section('title', 'Selamat Datang')
@push('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush
@section('content')
<div class="container mt-5 justify-content-center align-items-center" style="height: auto">
    <div class="row align-items-center justify-content-center ">
        <div class="col-7 text-center">
            <h2 style="font-weight: 5000">Selamat Datang Di Antrian Puskesmas</h2>
            <p>Silahkan pilih menu yang tersedia</p>
                <img src="{{ asset('storage/img/queue.jpg') }}" class="img-fluid" alt="">
        </div>
        <div class="col-5 mt-5">
            <a href="http://127.0.0.1:8001/login">
            <div class="col-12 m-3">
                <div class="card shadow-click bg-success text-center" style="width: 100%;">
                    <div class="card-body">
                        <span class="fa-solid fa-user"></span>
                        <h3 class="card-text">Menu User</h3>
                    </div>
                </div>
            </div>
            </a>
            <a href="http://127.0.0.1:8001/queues">
            <div class="col-12 m-3">
                <div class="card shadow-click bg-success text-center" style="width: 100%;">
                    <div class="card-body">
                        <span class="fa-solid fa-list-ol"></span>
                        <h3 class="card-text">Menu Antrian</h3>
                    </div>
                </div>
            </div>
            </a>
            <a href="http://127.0.0.1:8001/services">
            <div class="col-12 m-3">
                <div class="card shadow-click bg-success text-center" style="width: 100%;">
                    <div class="card-body">
                        <span class="fa-solid fa-grip"></span>
                        <h3 class="card-text">Menu Layanan</h3>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    </div>

@endsection

