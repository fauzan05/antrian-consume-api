{{-- Admin Sidebar Navigation --}}
<aside class="admin-sidebar bg-body border-end {{ $sidebarCollapsed ? 'collapsed' : '' }}">
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
                        <i class="fas fa-hospital-alt text-white" style="font-size: 22px;"></i>
                    </div>
                @endif
                <div class="flex-grow-1 sidebar-text">
                    <h5 class="mb-0 fw-bold text-truncate text-body" style="font-size: 16px;">
                        {{ $appSettings['name_of_health_institute'] ?? 'Admin Dashboard' }}
                    </h5>
                    <small class="text-body-secondary" style="font-size: 12px;">Queue System</small>
                </div>
            </div>
        </div>
        
        {{-- Navigation Menu --}}
        <nav class="flex-grow-1 py-3 overflow-auto">
            <div class="px-4 mb-3 sidebar-text">
                <small class="text-body-secondary text-uppercase" style="font-size: 11px; font-weight: 600; letter-spacing: 1px;">Menu Utama</small>
            </div>
            
            {{-- Dashboard --}}
            <a href="#" 
               wire:click.prevent="switchPage('dashboard')"
               class="sidebar-menu-item {{ $currentPage === 'dashboard' ? 'active' : '' }}"
               data-bs-toggle="tooltip"
               data-bs-placement="right"
               title="Dashboard">
                <i class="fas fa-home" style="width: 20px; font-size: 16px;"></i>
                <span class="sidebar-text" style="font-weight: 500; font-size: 14px;">Dashboard</span>
            </a>
            
            {{-- Loket --}}
            <a href="#"
               wire:click.prevent="switchPage('counters')"
               class="sidebar-menu-item {{ $currentPage === 'counters' ? 'active' : '' }}"
               data-bs-toggle="tooltip"
               data-bs-placement="right"
               title="Loket">
                <i class="fas fa-headset" style="width: 20px; font-size: 16px;"></i>
                <span class="sidebar-text" style="font-weight: 500; font-size: 14px;">Loket</span>
            </a>
            
            {{-- Layanan --}}
            <a href="#"
               wire:click.prevent="switchPage('services')"
               class="sidebar-menu-item {{ $currentPage === 'services' ? 'active' : '' }}"
               data-bs-toggle="tooltip"
               data-bs-placement="right"
               title="Layanan">
                <i class="fas fa-clipboard-list" style="width: 20px; font-size: 16px;"></i>
                <span class="sidebar-text" style="font-weight: 500; font-size: 14px;">Layanan</span>
            </a>
            
            {{-- Operator --}}
            <a href="#"
               wire:click.prevent="switchPage('users')"
               class="sidebar-menu-item {{ $currentPage === 'users' ? 'active' : '' }}"
               data-bs-toggle="tooltip"
               data-bs-placement="right"
               title="Operator">
                <i class="fas fa-users" style="width: 20px; font-size: 16px;"></i>
                <span class="sidebar-text" style="font-weight: 500; font-size: 14px;">Operator</span>
            </a>
            
            <div class="px-4 mt-4 mb-3 sidebar-text">
                <small class="text-body-secondary text-uppercase" style="font-size: 11px; font-weight: 600; letter-spacing: 1px;">Sistem</small>
            </div>
            
            {{-- Pengaturan --}}
            <a href="#"
               wire:click.prevent="switchPage('settings')"
               class="sidebar-menu-item {{ $currentPage === 'settings' ? 'active' : '' }}"
               data-bs-toggle="tooltip"
               data-bs-placement="right"
               title="Pengaturan">
                <i class="fas fa-cog" style="width: 20px; font-size: 16px;"></i>
                <span class="sidebar-text" style="font-weight: 500; font-size: 14px;">Pengaturan</span>
            </a>
        </nav>
        
        {{-- User Profile --}}
        <div class="border-top p-4">
            <div class="d-flex align-items-center">
                <div class="position-relative me-3">
                    <img src="{{ asset('storage/img/blank-profile.jpg') }}" 
                         alt="Profile" 
                         class="rounded-circle border"
                         style="width: 42px; height: 42px; object-fit: cover;">
                    <span class="position-absolute bottom-0 end-0 rounded-circle bg-success border border-2" 
                          style="width: 10px; height: 10px;"></span>
                </div>
                <div class="flex-grow-1 overflow-hidden sidebar-text">
                    <div class="text-truncate fw-semibold text-body" style="font-size: 14px;">{{ $user['name'] }}</div>
                    <small class="text-capitalize text-body-secondary" style="font-size: 12px;">{{ $user['role'] }}</small>
                </div>
            </div>
        </div>
    </div>
</aside>

@push('css')
<style>
    .sidebar-menu-item {
        position: relative;
        color: var(--bs-body-color);
        text-decoration: none;
        border-left: 3px solid transparent;
    }
    
    .sidebar-menu-item:not(.active):hover {
        background: rgba(82, 194, 52, 0.1) !important;
        border-left-color: var(--bs-success) !important;
        color: var(--bs-success) !important;
    }
    
    .sidebar-menu-item.active {
        background: linear-gradient(135deg, #52c234 0%, #38a169 100%) !important;
        border-left-color: var(--bs-success) !important;
        color: #fff !important;
        box-shadow: 0 4px 12px rgba(82, 194, 52, 0.2);
    }
    
    .sidebar-menu-item.active:hover {
        opacity: 0.95;
        transform: translateX(2px);
    }
    
    .sidebar-menu-item.active i,
    .sidebar-menu-item.active span {
        color: #fff !important;
    }
    
    .admin-sidebar.collapsed {
        width: 80px;
    }
    
    .admin-sidebar.collapsed .sidebar-text {
        display: none;
    }
    
    .admin-sidebar.collapsed .sidebar-menu-item {
        justify-content: center;
    }
    
    @media (max-width: 992px) {
        .admin-sidebar {
            transform: translateX(-100%);
        }
        
        .admin-sidebar.show {
            transform: translateX(0);
        }
    }
</style>
@endpush
