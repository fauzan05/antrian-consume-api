@push('css')
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
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        min-height: 200px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        width: 100%;
        position: relative;
    }
    
    .service-card:hover {
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        background: rgba(255, 255, 255, 1);
    }
    
    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: none !important;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.92);
        border-radius: 20px;
        z-index: 10;
        backdrop-filter: blur(3px);
    }
    
    .loading-overlay[style*="display"] {
        display: flex !important;
        animation: fadeIn 0.2s ease forwards;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid rgba(82, 194, 52, 0.2);
        border-top: 4px solid #52c234;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-bottom: 10px;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .loading-text {
        color: #52c234;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .service-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #52c234 0%, #38a169 100%);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
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
@endpush

<div class="services-container">
    <div class="container">
        <div class="services-header">
            <h1>Pilih Layanan</h1>
            <p>Silahkan pilih layanan yang Anda butuhkan</p>
        </div>

        @if (session('status'))
            <div class="alert alert-danger alert-custom text-center" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="services-grid">
            @foreach ($services as $service)
                <div wire:click="createQueue({{ $service['id'] }})" class="service-card">
                    <div class="service-content">
                        <div class="service-icon">
                            <i class="fa-solid fa-briefcase-medical"></i>
                        </div>
                        <h3 class="service-name">{{ $service['name'] }}</h3>
                    </div>
                    
                    <div wire:loading wire:target="createQueue({{ $service['id'] }})" class="loading-overlay">
                        <div class="spinner"></div>
                        <div class="loading-text">Memproses...</div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- <div class="back-link">
            <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Utama</a>
        </div> --}}
    </div>
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded');
        console.log('Livewire:', typeof Livewire !== 'undefined' ? 'Loaded' : 'Not Loaded');
        
        // Debug: log semua card yang ada
        const cards = document.querySelectorAll('.service-card');
        console.log('Service cards found:', cards.length);
        
        // Debug: cek apakah ada wire:id pada component
        const livewireComponent = document.querySelector('[wire\\:id]');
        console.log('Livewire component found:', livewireComponent ? 'Yes' : 'No');
        if (livewireComponent) {
            console.log('Wire ID:', livewireComponent.getAttribute('wire:id'));
        }
        
        // Debug: cek wire:click pada cards
        cards.forEach((card, index) => {
            console.log(`Card ${index} has wire:click:`, card.hasAttribute('wire:click'));
        });
    });
</script>
@endpush
