<!DOCTYPE html>
<html lang="en" data-bs-theme="{{ Cookie::get('dark_mode') === 'true' ? 'dark' : 'light' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard Operator')</title>
    
    {{-- CSS Dependencies --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.4.2-web/css/all.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dark-mode.css') }}">
    
    @stack('css')
</head>

<body class="bg-body-tertiary">
    {{-- Header (includes Sidebar & Navbar) --}}
    @include('layouts.dashboard.operator.header', ['user' => $user])
    
    {{-- Main Content --}}
    @yield('content')
    
    {{-- Footer --}}
    @include('layouts.dashboard.operator.footer')
    
    {{-- JavaScript Dependencies --}}
    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    
    {{-- Initialize Bootstrap Tooltips --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        });
        
        // Dark mode toggle handler with Livewire
        document.addEventListener('livewire:init', () => {
            Livewire.on('dark-mode-toggled', (event) => {
                const html = document.documentElement;
                const newTheme = event.darkMode ? 'dark' : 'light';
                html.setAttribute('data-bs-theme', newTheme);
                
                // Store in localStorage for persistence
                localStorage.setItem('theme', newTheme);
            });
        });
        
        // Apply theme from localStorage on page load
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const cookieTheme = '{{ Cookie::get("dark_mode") === "true" ? "dark" : "light" }}';
            const theme = savedTheme || cookieTheme;
            document.documentElement.setAttribute('data-bs-theme', theme);
        })();
    </script>
    
    @stack('js')
</body>
</html>
