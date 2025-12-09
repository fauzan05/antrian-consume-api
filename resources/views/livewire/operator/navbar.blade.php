{{-- Top Navigation Bar --}}
<nav class="bg-body border-bottom sticky-top" style="padding: 20px 32px; z-index: 999;">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h4 class="mb-1 fw-bold text-body">
                @if($currentPage === 'queues')
                    Dashboard Antrian
                @elseif($currentPage === 'settings')
                    Pengaturan Akun
                @endif
            </h4>
            <small class="text-body-secondary" style="font-size: 13px;">
                <i class="far fa-calendar-alt me-1"></i>
                {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
            </small>
        </div>
        
        <div class="d-flex align-items-center gap-2">
            <button wire:click="toggleDarkMode"
                    class="btn btn-outline-secondary border"
                    style="width: 40px; height: 40px; padding: 0; border-radius: 8px;"
                    data-bs-toggle="tooltip" 
                    data-bs-placement="bottom" 
                    title="{{ $darkMode ? 'Mode Terang' : 'Mode Gelap' }}">
                <i class="fas fa-{{ $darkMode ? 'sun' : 'moon' }}" style="{{ $darkMode ? 'color: #fbbf24;' : '' }}"></i>
            </button>
            
            <button class="btn btn-outline-secondary border position-relative"
                    style="width: 40px; height: 40px; padding: 0; border-radius: 8px;"
                    data-bs-toggle="tooltip" 
                    data-bs-placement="bottom" 
                    title="Inbox">
                <i class="fas fa-envelope"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">3</span>
            </button>
            
            <button class="btn btn-outline-secondary border position-relative"
                    style="width: 40px; height: 40px; padding: 0; border-radius: 8px;"
                    data-bs-toggle="tooltip" 
                    data-bs-placement="bottom" 
                    title="Notifikasi">
                <i class="fas fa-bell"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark" style="font-size: 10px;">5</span>
            </button>
            
            <div class="vr" style="height: 30px;"></div>
            
            <button wire:click="logout" 
                    class="btn btn-outline-danger d-flex align-items-center"
                    style="border-radius: 8px; padding: 10px 20px; font-size: 14px;"
                    data-bs-toggle="tooltip" 
                    data-bs-placement="bottom" 
                    title="Logout">
                <i class="fas fa-power-off me-2" style="font-size: 13px;"></i>
                Logout
            </button>
        </div>
    </div>
</nav>
