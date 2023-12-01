@extends('layouts.services')
@section('title', 'Menu Layanan')
@push('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush
@section('content')
    @livewire('services-menus')
@endsection