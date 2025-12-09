{{-- Admin Top Navigation Bar --}}
<nav class="admin-navbar bg-body border-bottom sticky-top">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between h-100 px-3 px-lg-4" style="padding-top: 12px; padding-bottom: 12px;">
            {{-- Left Section --}}
            <div class="d-flex align-items-center gap-3">
                <button wire:click="toggleSidebar" 
                        class="btn btn-light d-lg-none p-0" 
                        style="width: 36px; height: 36px; border-radius: 8px;">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div>
                    <h5 class="mb-0 fw-semibold text-body" style="font-size: 16px; line-height: 1.2;">
                        @if($currentPage === 'dashboard')
                            Dashboard Admin
                        @elseif($currentPage === 'counters')
                            Manajemen Loket
                        @elseif($currentPage === 'services')
                            Manajemen Layanan
                        @elseif($currentPage === 'users')
                            Manajemen Operator
                        @elseif($currentPage === 'settings')
                            Pengaturan Sistem
                        @endif
                    </h5>
                    <div class="text-body-secondary d-none d-md-block" style="font-size: 11px; margin-top: 2px;">
                        <i class="far fa-calendar-alt me-1"></i>
                        {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                    </div>
                </div>
            </div>
            
            {{-- Right Section --}}
            <div class="d-flex align-items-center gap-2">
                {{-- Dark Mode Toggle --}}
                <button wire:click="toggleDarkMode"
                        class="btn btn-light"
                        style="width: 36px; height: 36px; padding: 0; border-radius: 8px;"
                        data-bs-toggle="tooltip" 
                        data-bs-placement="bottom" 
                        title="{{ $darkMode ? 'Mode Terang' : 'Mode Gelap' }}">
                    <i class="fas fa-{{ $darkMode ? 'sun' : 'moon' }}" style="{{ $darkMode ? 'color: #fbbf24;' : '' }}"></i>
                </button>
                
                {{-- Notifications --}}
                <button class="btn btn-light position-relative"
                        style="width: 36px; height: 36px; padding: 0; border-radius: 8px;"
                        data-bs-toggle="tooltip" 
                        data-bs-placement="bottom" 
                        title="Notifikasi">
                    <i class="fas fa-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" 
                          style="font-size: 9px; padding: 3px 5px;">5</span>
                </button>
                
                {{-- Messages --}}
                <button class="btn btn-light position-relative"
                        style="width: 36px; height: 36px; padding: 0; border-radius: 8px;"
                        data-bs-toggle="tooltip" 
                        data-bs-placement="bottom" 
                        title="Pesan">
                    <i class="fas fa-envelope"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark" 
                          style="font-size: 9px; padding: 3px 5px;">3</span>
                </button>
                
                <div class="vr d-none d-md-block mx-1" style="margin-top: 8px !important; height: 24px; opacity: 0.2;"></div>
                
                {{-- User Profile Dropdown --}}
                <div class="dropdown">
                    <button class="btn btn-light d-flex align-items-center gap-2 dropdown-toggle" 
                            type="button" 
                            id="userDropdown" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false"
                            style="border-radius: 8px; padding: 6px 12px; height: 36px;">
                        <i class="fas fa-user-circle d-md-none" style="font-size: 16px;"></i>
                        <img src="{{ asset('storage/img/blank-profile.jpg') }}" 
                             alt="Profile" 
                             class="rounded-circle d-none d-md-block"
                             style="width: 24px; height: 24px; object-fit: cover;">
                        <div class="text-start d-none d-lg-block" style="line-height: 1.2;">
                            <div class="text-body fw-medium" style="font-size: 13px;">{{ $user['name'] }}</div>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="userDropdown" style="min-width: 200px; margin-top: 8px;">
                        <li class="px-3 py-2 border-bottom">
                            <div class="text-body fw-semibold" style="font-size: 14px;">{{ $user['name'] }}</div>
                            <small class="text-body-secondary text-capitalize" style="font-size: 12px;">{{ $user['role'] }}</small>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="#" style="font-size: 13px;">
                                <i class="fas fa-user-circle me-2 text-body-secondary" style="width: 16px;"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="#" wire:click.prevent="switchPage('settings')" style="font-size: 13px;">
                                <i class="fas fa-cog me-2 text-body-secondary" style="width: 16px;"></i> Pengaturan
                            </a>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <a class="dropdown-item py-2 text-danger" href="#" wire:click.prevent="logout" style="font-size: 13px;">
                                <i class="fas fa-power-off me-2" style="width: 16px;"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

@push('css')
<style>
    .admin-navbar {
        backdrop-filter: blur(10px);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    .admin-navbar .btn-light {
        background: transparent;
        border: 1px solid rgba(0, 0, 0, 0.08);
        color: var(--bs-body-color);
        transition: all 0.2s ease;
    }
    
    .admin-navbar .btn-light:hover {
        background: rgba(0, 0, 0, 0.04);
        border-color: rgba(0, 0, 0, 0.12);
        transform: translateY(-1px);
    }
    
    [data-bs-theme="dark"] .admin-navbar .btn-light {
        border-color: rgba(255, 255, 255, 0.1);
    }
    
    [data-bs-theme="dark"] .admin-navbar .btn-light:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.15);
    }
    
    .dropdown-menu {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.08);
    }
    
    [data-bs-theme="dark"] .dropdown-menu {
        border-color: rgba(255, 255, 255, 0.1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
    }
    
    .dropdown-item {
        padding: 8px 16px;
        border-radius: 8px;
        margin: 2px 8px;
        transition: all 0.15s ease;
    }
    
    .dropdown-item:hover {
        background: rgba(82, 194, 52, 0.1);
    }
    
    .dropdown-item.text-danger:hover {
        background: rgba(220, 53, 69, 0.1);
    }
</style>
@endpush
