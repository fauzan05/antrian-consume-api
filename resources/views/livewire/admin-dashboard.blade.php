<div class="d-flex min-vh-100 bg-body-tertiary" data-bs-theme="{{ $darkMode ? 'dark' : 'light' }}">
    {{-- Sidebar --}}
    @include('livewire.admin.sidebar')
    
    {{-- Main Content Area --}}
    <main class="flex-grow-1" style="margin-left: 280px; width: calc(100% - 280px);">
        {{-- Top Navigation Bar --}}
        @include('livewire.admin.navbar')
        
        {{-- Page Content --}}
        <div class="bg-body-tertiary d-flex flex-column" style="min-height: calc(100vh - 64px); padding-top: 24px;">
            <div class="container-fluid flex-grow-1" style="padding: 0 32px 24px 32px;">
                @if($currentPage === 'dashboard')
                    @livewire('admin-dashboard-content')
                @elseif($currentPage === 'counters')
                    @livewire('admin-counters-content', ['token' => $token])
                @elseif($currentPage === 'services')
                    @livewire('admin-services-content', ['token' => $token])
                @elseif($currentPage === 'users')
                    @livewire('admin-users-content', ['token' => $token])
                @elseif($currentPage === 'settings')
                    @livewire('admin-settings-content', ['token' => $token])
                @endif
            </div>
            
            {{-- Footer --}}
            @include('livewire.admin.footer')
        </div>
    </main>
</div>

@push('css')
<style>
    main {
        transition: margin-left 0.3s ease, width 0.3s ease;
    }
    
    .admin-sidebar.collapsed ~ main {
        margin-left: 80px;
        width: calc(100% - 80px);
    }
    
    @media (max-width: 992px) {
        main {
            margin-left: 0 !important;
            width: 100% !important;
        }
    }
</style>
@endpush
