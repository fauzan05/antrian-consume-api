<div>
    {{-- <input type="hidden" name="token" data-csrf="{{csrf_token()}}" value="{{ csrf_token() }}"> --}}
    @if (session('status'))
        {{ $active = (integer)session('status')['page'] }}
    @endif
    <nav class="sidebar p-2 shadow-sm {{ $closed == true && isset($active) ? 'close-sidebar' : '' }}">
        <li class="nav-link header rounded">
            <div class="logo-image">
                <img class="logo-width" src="{{ asset('storage/img/logo-puskesmas.png') }}" alt="">
            </div>
            <div>
                <span class="text name">{{ $name_of_institute }}</span>
                <p class="text-address">
                    {{$address}}
                </p>
            </div>
        </li>
        <i id="toggle" wire:click="isClosed({{ $active }})"
            class="fa-solid rounded-circle fa-chevron-left toggle shadow"></i>
        <hr>
        
        <div class="menu-bar">
            <div class="top-menu">
                <ul class="menu-links centered">
                    <li class="nav-link" style="width: 100%;">
                        <a href="#" wire:click.prevent="countIndexMenu({{ (integer)1 }})"
                            class="rounded {{ $active == 1 ? 'active' : '' }}" style="width: 100%; height: 100%;">
                            <i id="dashboard-tooltip" data-bs-placement="right" data-bs-title="Dashboard"
                                class="fa-solid fa-house icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link" style="width: 100%;">
                        <a href="#" wire:click.prevent="countIndexMenu({{ (integer)2 }})"
                            class="rounded {{ $active == 2 ? 'active' : '' }}" style="width: 100%; height: 100%;">
                            <i id="counters-tooltip" data-bs-placement="right" data-bs-title="Loket"
                                class="fa-solid fa-headset icon"></i>
                            <span class="text nav-text">Loket</span>
                        </a>
                    </li>
                    <li class="nav-link" style="width: 100%;">
                        <a href="#" wire:click.prevent="countIndexMenu({{ (integer)3 }})"
                            class="rounded {{ $active == 3 ? 'active' : '' }}" style="width: 100%; height: 100%;">
                            <i id="services-tooltip" data-bs-placement="right" data-bs-title="Layanan"
                                class="fa-solid fa-clipboard-list icon"></i>
                            <span class="text nav-text">Layanan</span>
                        </a>
                    </li>
                    <li class="nav-link" style="width: 100%;">
                        <a href="#" wire:click.prevent="countIndexMenu({{ (integer)4 }})"
                            class="rounded {{ $active == 4 ? 'active' : '' }}" style="width: 100%; height: 100%;">
                            <i id="users-tooltip" data-bs-placement="right" data-bs-title="Operator"
                                class="fa-solid fa-users icon"></i>
                            <span class="text nav-text">Operator</span>
                        </a>
                    </li>
                    <li class="nav-link" style="width: 100%;">
                        <a href="#" wire:click.prevent="countIndexMenu({{ (integer)5 }})"
                            class="rounded {{ $active == 5 ? 'active' : '' }}" style="width: 100%; height: 100%;">
                            <i id="settings-tooltip" data-bs-placement="right" data-bs-title="Pengaturan"
                                class="fa-solid fa-gear icon"></i>
                            <span class="text nav-text">Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-menu">
                <li class="nav-link shadow-sm rounded">
                    <i class="fa-solid fa-user icon"></i>
                    <div class="user-info">
                        <span class="text nav-text name">{{ $currentUser['name'] }}</span>
                        <span class="text nav-text role">{{ $currentUser['role'] }}</span>
                    </div>
                </li>
            </div>
        </div>
    </nav>
    <div class="home {{ $closed == true ? 'close-home' : '' }}">
        <div class="row no-padding row-height">
            <nav class="navbar {{ $closed == true ? 'close-navbar' : '' }}">
                <div class="menu-bar">
                    <ul class="menu-links rounded shadow-sm">
                        <li class="nav-link nav-text-border">
                            <span class="text nav-text">Dashboard | Admin</span>
                        </li>
                        {{-- <input type="hidden" name="token" data-csrf="{{csrf_token()}}" value="{{ csrf_token() }}"> --}}
                        <li class="nav-link mode">
                            <div class="moon-sun">
                                <i class="fa-solid fa-moon icon"></i>
                                <i class="fa-regular fa-sun"></i>
                            </div>
                            <div wire:click="darkModes({{$active}})" class="toggle-switch">
                                <span class="switch"></span>
                            </div>
                        </li>
                        <li class="nav-link">
                            <i id="logout-tooltip" wire:click="logout()" class="fa-solid fa-right-from-bracket logout-icon"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Logout"></i>
                        </li>
                    </ul>
                </div>
            </nav>
            @if ($active == 1)
                <livewire:admin-dashboard-content>
                @elseif($active == 2)
                    <livewire:admin-counters-content :token=$token>
                    @elseif($active == 3)
                        <livewire:admin-services-content :token=$token>
                        @elseif($active == 4)
                            <livewire:admin-users-content :token=$token>
                            @elseif($active == 5)
                                <livewire:admin-settings-content :token=$token>
            @endif
        </div>
    </div>
</div>
