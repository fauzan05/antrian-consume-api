<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.min.css') }}">
    @livewireStyles
    @stack('css')
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.4.2-web/css/all.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;700&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
</head>
@php
    $darkMode = Cookie::get('dark-mode');
@endphp

<body class="{{ (bool) $darkMode ? 'dark' : 'light' }}">

    {{-- Header --}}
    @include('layouts.dashboard.admin.header')
    {{-- Content --}}
    @yield('content')
    {{-- Footer --}}
    @include('layouts.dashboard.admin.footer')

    @livewireScripts
    @stack('js')

</body>

</html>
