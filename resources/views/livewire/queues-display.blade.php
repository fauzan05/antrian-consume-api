@push('css')
<style>
    body {
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
    }

    .display-container {
        padding: 30px 40px;
        min-height: calc(100vh - 200px);
    }

    .main-display-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    /* Current Queue Card */
    .queue-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 25px;
        padding: 50px 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        text-align: center;
        position: relative;
        overflow: hidden;
        min-height: 500px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .queue-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 8px;
        background: linear-gradient(90deg, #52c234, #38a169, #52c234);
        background-size: 200% 100%;
        animation: gradientMove 3s ease infinite;
    }

    @keyframes gradientMove {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .queue-label {
        color: #2d3748;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .queue-label i {
        font-size: 2rem;
        color: #52c234;
    }

    .queue-number {
        font-size: 10rem;
        font-weight: 900;
        color: #52c234;
        margin: 30px 0;
        text-shadow: 0 5px 25px rgba(82, 194, 52, 0.3);
        line-height: 1;
        animation: pulse 2s ease-in-out infinite;
        font-family: 'Arial Black', sans-serif;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .queue-service {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
        padding: 20px 40px;
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
        border-radius: 20px;
        margin-top: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        box-shadow: 0 4px 15px rgba(82, 194, 52, 0.2);
    }

    .queue-service i {
        color: #52c234;
    }

    /* Video Section */
    .video-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 25px;
        padding: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        min-height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .video-card video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    /* Counter Queues Section */
    .counter-section {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 25px;
        padding: 35px 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }

    .counter-title {
        text-align: center;
        color: #2d3748;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .counter-title i {
        font-size: 2rem;
        color: #52c234;
    }

    .counters-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 25px;
    }

    .counter-card {
        background: linear-gradient(135deg, #52c234 0%, #38a169 100%);
        border-radius: 20px;
        padding: 30px 25px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(82, 194, 52, 0.4);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .counter-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
        animation: rotate 10s linear infinite;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .counter-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 10px 35px rgba(82, 194, 52, 0.5);
    }

    .counter-name {
        color: white;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 18px;
        position: relative;
        z-index: 1;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .counter-number {
        color: white;
        font-size: 4rem;
        font-weight: 900;
        position: relative;
        z-index: 1;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        font-family: 'Arial Black', sans-serif;
    }

    .counter-divider {
        height: 4px;
        background: rgba(255, 255, 255, 0.4);
        margin: 18px 0;
        position: relative;
        z-index: 1;
        border-radius: 2px;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 40px;
        color: white;
        font-size: 1.2rem;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .main-display-grid {
            grid-template-columns: 1fr;
        }

        .queue-number {
            font-size: 7rem;
        }

        .counters-grid {
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .display-container {
            padding: 20px;
        }

        .queue-number {
            font-size: 5rem;
        }

        .queue-label {
            font-size: 1.4rem;
        }

        .queue-service {
            font-size: 1.4rem;
            padding: 15px 25px;
        }

        .counter-number {
            font-size: 2.5rem;
        }

        .counter-name {
            font-size: 1rem;
        }

        .counter-title {
            font-size: 1.4rem;
        }
    }
</style>
@endpush

<div class="display-container">
    <!-- Main Display: Queue Number & Video -->
    <div class="main-display-grid">
        <!-- Current Queue Card -->
        <div class="queue-card">
            <div class="queue-label">
                <i class="fa-solid fa-ticket"></i>
                <span>Nomor Antrian</span>
            </div>
            <div class="queue-number">{{ $nextQueue ?? '-' }}</div>
            <div class="queue-service">
                <i class="fa-solid fa-briefcase-medical"></i>
                <span>{{ $nextService ?? 'Menunggu...' }}</span>
            </div>
        </div>

        <!-- Video Card -->
        <div class="video-card">
            <video loop autoplay muted>
                <source src="{{asset('assets/video/' . $selected_video)}}">
                Browser Anda tidak mendukung video.
            </video>
        </div>
    </div>

    <!-- Counter Queues Section -->
    <div class="counter-section">
        <h2 class="counter-title">
            <i class="fa-solid fa-desktop"></i>
            <span>Antrian di Loket</span>
        </h2>
        <div class="counters-grid">
            @forelse ($currentQueues as $item)
                <div class="counter-card">
                    <div class="counter-name">{{ $item['name'] }}</div>
                    <div class="counter-divider"></div>
                    <div class="counter-number">{{ $item['number'] }}</div>
                </div>
            @empty
                <div class="counter-card empty-state">
                    <i class="fa-solid fa-info-circle" style="font-size: 2rem; margin-bottom: 10px;"></i>
                    <div>Tidak ada antrian saat ini</div>
                </div>
            @endforelse
        </div>
    </div>
</div>
