@push('css')
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, #52c234 0%, #38a169 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            width: 100%;
            padding: 20px;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 25px;
            padding: 50px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            max-width: 1100px;
            margin: 0 auto;
        }
        
        .login-title h2 {
            color: #2d3748;
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 15px;
        }
        
        .login-title p {
            color: #718096;
            font-size: 1rem;
            margin-bottom: 30px;
        }
        
        .image-section {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        
        .image-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            background: #f7fafc;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .image-container img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }
        
        .form-section {
            padding-left: 30px;
        }
        
        .form-label {
            color: #2d3748;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #52c234;
            box-shadow: 0 0 0 3px rgba(82, 194, 52, 0.1);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #52c234 0%, #38a169 100%);
            border: none;
            border-radius: 12px;
            padding: 14px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(82, 194, 52, 0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(82, 194, 52, 0.4);
        }
        
        .alert {
            border-radius: 12px;
            border: none;
        }
        
        .error {
            font-size: 0.875rem;
            margin-top: 5px;
            display: block;
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: #52c234;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .back-link a:hover {
            color: #38a169;
        }
        
        @media (max-width: 991px) {
            .login-card {
                padding: 40px 30px;
            }
            
            .form-section {
                padding-left: 0;
                margin-top: 30px;
            }
            
            .login-title h2 {
                font-size: 1.8rem;
            }
        }
        
        @media (max-width: 576px) {
            .login-card {
                padding: 30px 20px;
            }
            
            .login-title h2 {
                font-size: 1.5rem;
            }
        }
    </style>
@endpush
@extends('layouts.login')
@section('title', 'Login User')
@section('content')
    <div class="login-container">
        <div class="login-card">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="image-section">
                        <div class="login-title text-center">
                            <h2>Selamat Datang</h2>
                            <p>Silahkan masukkan username dan password dengan benar</p>
                        </div>
                        <div class="image-container">
                            <img src="{{ asset('storage/img/login.jpg') }}" class="img-fluid" alt="Login">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    @livewire('login')
                </div>
            </div>
        </div>
    </div>
@endsection
