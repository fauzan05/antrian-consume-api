@push('css')
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush
@extends('layouts.operator-dashboard')
@section('title', 'Dashboard Operator')
@section('content')
    <div class="overflow-y-scroll" style="max-height: 85vh;">
        @livewire('queues-menus', ['user' => $user, 'token' => Cookie::get('token')])
    </div>
@endsection
