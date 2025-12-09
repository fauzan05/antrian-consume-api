{{-- Sidebar Component --}}
<aside class="sidebar bg-body border-end" style="width: 280px; position: fixed; height: 100vh; left: 0; top: 0; z-index: 1000; box-shadow: 2px 0 12px rgba(0,0,0,0.08);">
    <div class="d-flex flex-column h-100">
        {{-- Logo & Brand --}}
        <div class="border-bottom p-4">
            <div class="d-flex align-items-center">
                @if(!empty($appSettings['selected_logo']))
                    <img src="{{ asset('assets/logo/' . $appSettings['selected_logo']) }}" 
                         alt="Logo" 
                         class="rounded me-3"
                         style="width: 50px; height: 50px; object-fit: contain;">
                @else
                    <div class="rounded me-3 d-flex align-items-center justify-content-center" 
                         style="width: 50px; height: 50px; background: linear-gradient(135deg, #52c234 0%, #38a169 100%); box-shadow: 0 4px 12px rgba(82, 194, 52, 0.2);">
                        <i class="fas fa-hospital-alt text-white" style="font-size: 20px;"></i>
                    </div>
                @endif
                <div class="flex-grow-1">
                    <h5 class="mb-0 fw-bold text-truncate text-body" style="font-size: 16px;">
                        {{ $appSettings['name_of_health_institute'] ?? 'Antrian Demo' }}
                    </h5>
                    <small class="text-body-secondary" style="font-size: 12px;">Queue System</small>
                </div>
            </div>
        </div>
        
        {{-- Navigation Menu --}}
        <nav class="flex-grow-1 py-3">
            <div class="px-4 mb-3">
                <small class="text-body-secondary text-uppercase" style="font-size: 11px; font-weight: 600; letter-spacing: 1px;">Menu</small>
            </div>
            
            <a href="#" 
               wire:click.prevent="switchPage('queues')"
               class="nav-menu-item d-flex align-items-center text-decoration-none {{ $currentPage === 'queues' ? 'active' : '' }}"
               style="padding: 12px 20px; margin: 0 12px 8px 12px; border-radius: 8px; transition: all 0.2s;">
                <i class="fas fa-list-ol" style="width: 20px; font-size: 14px;"></i>
                <span class="ms-3" style="font-weight: 500; font-size: 14px;">Antrian</span>
            </a>
            
            <a href="#"
               wire:click.prevent="switchPage('settings')"
               class="nav-menu-item d-flex align-items-center text-decoration-none {{ $currentPage === 'settings' ? 'active' : '' }}"
               style="padding: 12px 20px; margin: 0 12px 8px 12px; border-radius: 8px; transition: all 0.2s;">
                <i class="fas fa-cog" style="width: 20px; font-size: 14px;"></i>
                <span class="ms-3" style="font-weight: 500; font-size: 14px;">Pengaturan</span>
            </a>
        </nav>
        
        {{-- User Profile --}}
        <div class="border-top p-4 bg-body-secondary">
            <div class="d-flex align-items-center">
                <div class="position-relative me-3">
                    <img src="{{ asset('storage/img/blank-profile.jpg') }}" 
                         alt="Profile" 
                         class="rounded-circle border"
                         style="width: 42px; height: 42px; object-fit: cover;">
                    <span class="position-absolute bottom-0 end-0 rounded-circle bg-success border border-2" 
                          style="width: 10px; height: 10px;"></span>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <div class="text-truncate fw-semibold text-body" style="font-size: 14px;">{{ $user['name'] }}</div>
                    <small class="text-capitalize text-body-secondary" style="font-size: 12px;">{{ $user['role'] }}</small>
                </div>
            </div>
        </div>
    </div>
</aside>

@push('css')
<style>
    .nav-menu-item {
        color: var(--bs-secondary-color);
        border-left: 3px solid transparent;
    }
    
    .nav-menu-item:not(.active):hover {
        background: var(--bs-success-bg-subtle) !important;
        border-left-color: var(--bs-success) !important;
        color: var(--bs-success) !important;
    }
    
    .nav-menu-item.active {
        background: linear-gradient(135deg, #52c234 0%, #38a169 100%) !important;
        border-left-color: var(--bs-success) !important;
        color: #fff !important;
        box-shadow: 0 4px 12px rgba(82, 194, 52, 0.2);
    }
    
    .nav-menu-item.active:hover {
        opacity: 0.95;
        transform: translateY(-1px);
    }
    
    .nav-menu-item.active i,
    .nav-menu-item.active span {
        color: #fff !important;
    }
</style>
@endpush
