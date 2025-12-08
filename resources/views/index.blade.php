@push('css')
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, #52c234 0%, #38a169 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        
        .hero-section {
            min-height: 100vh;
            padding: 40px 0;
            display: flex;
            align-items: center;
        }
        
        .welcome-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 25px;
            padding: 50px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            margin-top: 20px;
        }
        
        .title-section h1 {
            color: #2d3748;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .title-section p {
            color: #718096;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        
        .subtitle {
            color: #4a5568;
            font-size: 0.95rem;
            font-weight: 500;
            margin-top: 20px;
        }
        
        .menu-card {
            background: linear-gradient(135deg, #52c234 0%, #38a169 100%);
            border: none;
            border-radius: 20px;
            padding: 35px 25px;
            margin-bottom: 20px;
            transition: all 0.4s ease;
            text-decoration: none;
            display: block;
            box-shadow: 0 8px 20px rgba(82, 194, 52, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .menu-card:hover::before {
            left: 100%;
        }
        
        .menu-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 35px rgba(82, 194, 52, 0.4);
        }
        
        .menu-card .icon {
            font-size: 3.5rem;
            margin-bottom: 10px;
            color: #ffffff;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
        }
        
        .menu-card h3 {
            color: #ffffff;
            font-weight: 600;
            margin: 0;
            font-size: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .image-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            background: #f7fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 300px;
        }
        
        .image-container img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }
        
        .image-placeholder {
            color: #cbd5e0;
            font-size: 4rem;
        }
        
        @media (max-width: 991px) {
            .hero-section {
                padding: 30px 0;
            }
            
            .welcome-card {
                padding: 30px 25px;
            }
            
            .title-section h1 {
                font-size: 2rem;
            }
            
            .menu-card {
                padding: 25px 20px;
            }
            
            .menu-card .icon {
                font-size: 2.5rem;
            }
            
            .menu-card h3 {
                font-size: 1.25rem;
            }
        }
        
        @media (max-width: 576px) {
            .title-section h1 {
                font-size: 1.6rem;
            }
            
            .image-container {
                min-height: 200px;
            }
        }
    </style>
@endpush
@extends('layouts.app')
@section('title', 'Selamat Datang')
@section('content')
    <div class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-xl-10">
                    <div class="welcome-card">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                <div class="title-section text-center text-lg-start">
                                    <h1>Selamat Datang di<br>Antrian Puskesmas</h1>
                                    <p>Silahkan pilih menu yang tersedia untuk melanjutkan</p>
                                </div>
                                <div class="image-container">
                                    <img src="{{ asset('storage/img/queue.jpg') }}" alt="Queue Management System" 
                                         onerror="this.style.display='none'; this.parentElement.innerHTML='<i class=\'fa-solid fa-image image-placeholder\'></i>'">
                                </div>
                                <p class="subtitle text-center text-lg-start">Queue Management System</p>
                            </div>
                            <div class="col-lg-6">
                                <a href="{{ url('login') }}" class="menu-card">
                                    <div class="text-center">
                                        <div class="icon">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <h3>Menu User</h3>
                                    </div>
                                </a>
                                
                                <a href="{{ url('queues') }}" class="menu-card">
                                    <div class="text-center">
                                        <div class="icon">
                                            <i class="fa-solid fa-list-ol"></i>
                                        </div>
                                        <h3>Menu Antrian</h3>
                                    </div>
                                </a>
                                
                                <a href="{{ url('services') }}" class="menu-card">
                                    <div class="text-center">
                                        <div class="icon">
                                            <i class="fa-solid fa-grip"></i>
                                        </div>
                                        <h3>Menu Layanan</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
