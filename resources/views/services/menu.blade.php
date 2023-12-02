@push('css')
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush
@extends('layouts.services')
@section('title', 'Menu Layanan')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush
@section('content')
    @livewire('services-menus')
@endsection
