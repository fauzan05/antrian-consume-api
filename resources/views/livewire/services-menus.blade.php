<style>
    body {
        background: linear-gradient(135deg, #52c234 0%, #38a169 100%);
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }
    
    .services-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }
    
    .services-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .services-header h1 {
        color: white;
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 15px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    
    .services-header p {
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.1rem;
    }
    
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        max-width: 1200px;
        width: 100%;
        margin: 0 auto;
    }
    
    .service-card {
        background: rgba(255, 255, 255, 0.98);
        border: none;
        border-radius: 20px;
        padding: 40px 30px;
        cursor: pointer;
        transition: all 0.4s ease;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 200px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        position: relative;
        overflow: hidden;
    }
    
    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(82, 194, 52, 0.1), transparent);
        transition: left 0.5s;
    }
    
    .service-card:hover::before {
        left: 100%;
    }
    
    .service-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
    }
    
    .service-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #52c234 0%, #38a169 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(82, 194, 52, 0.3);
    }
    
    .service-icon i {
        font-size: 2rem;
        color: white;
    }
    
    .service-name {
        color: #2d3748;
        font-weight: 600;
        font-size: 1.4rem;
        margin: 0;
        text-align: center;
        line-height: 1.4;
    }
    
    .alert-custom {
        background: rgba(255, 255, 255, 0.98);
        border: none;
        border-radius: 15px;
        padding: 20px 30px;
        margin-bottom: 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        border-left: 5px solid #dc3545;
    }
    
    .back-link {
        text-align: center;
        margin-top: 40px;
    }
    
    .back-link a {
        color: white;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-block;
        padding: 12px 30px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        backdrop-filter: blur(10px);
    }
    
    .back-link a:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .services-header h1 {
            font-size: 2rem;
        }
        
        .services-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .service-card {
            min-height: 180px;
            padding: 30px 20px;
        }
        
        .service-name {
            font-size: 1.2rem;
        }
    }
</style>

<div class="services-container">
    <div class="container">
        <div class="services-header">
            <h1>Pilih Layanan</h1>
            <p>Silahkan pilih layanan yang Anda butuhkan</p>
        </div>
        
        @if(session('status'))
        <div class="alert alert-danger alert-custom text-center" role="alert">
           {{session('status')}}
        </div>
        @endif
        
        <div class="services-grid">
            @foreach ($services as $service)
                <div wire:click.prevent="createQueue({{ $service['id'] }})" class="service-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-briefcase-medical"></i>
                    </div>
                    <h3 class="service-name">{{ $service['name'] }}</h3>
                </div>
            @endforeach
        </div>
        
        {{-- <div class="back-link">
            <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Utama</a>
        </div> --}}
    </div>
</div>