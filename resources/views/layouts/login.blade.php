<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('css')
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.4.2-web/css/all.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;700&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
</head>

<body>

    {{-- Header --}}
    @include('layouts.login.header')
    {{-- Content --}}
    @yield('content')
    {{-- Footer --}}
    @include('layouts.login.footer')
    @stack('js')
    
</body>

</html>
