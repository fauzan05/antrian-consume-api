<div class="d-flex min-vh-100 bg-body-tertiary" data-bs-theme="{{ $darkMode ? 'dark' : 'light' }}">
    {{-- Sidebar --}}
    @include('livewire.operator.sidebar')
    
    {{-- Main Content Area --}}
    <main class="flex-grow-1" style="margin-left: 280px; width: calc(100% - 280px);">
        {{-- Top Navigation Bar --}}
        @include('livewire.operator.navbar')
        
        {{-- Page Content --}}
        <div class="bg-body-tertiary" style="min-height: calc(100vh - 76px);">
            <div class="container-fluid" style="padding: 32px;">
                @if($currentPage === 'queues')
                    @livewire('queues-menus', ['user' => $user, 'token' => $token])
                @elseif($currentPage === 'settings')
                    @livewire('change-password', ['token' => $token])
                @endif
            </div>
            
            {{-- Footer --}}
            @include('livewire.operator.footer')
        </div>
    </main>
</div>

@push('css')
<style>
    .nav-menu-item:hover {
        background: rgba(255, 255, 255, 0.05) !important;
        color: #fff !important;
    }
</style>
@endpush
