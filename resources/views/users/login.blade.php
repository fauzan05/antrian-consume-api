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
            <div class="col-5">
                @if (session()->has('message_401'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('message_401') }}
                    </div>
                @endif
                @if(session()->has('message_session'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('message_session') }}
                </div>
                @endif
                <form method="post" action="{{ url('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="username" name="username" class="form-control" id="username">
                        @if (session()->has('message_400'))
                            <span class="text-danger">{{ session()->get('message_400')[0] }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        @if (session()->has('message_400'))
                            <span class="text-danger">{{ session()->get('message_400')[1] }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Masuk</button>
                </form>
            </div>
        </div>
    </div>
@endsection
