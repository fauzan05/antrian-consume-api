@extends('layouts.operator-dashboard')

@section('title', 'Dashboard Operator - Pengaturan')

@section('content')
    <div class="overflow-y-auto" style="max-height: 85vh;">
        @livewire('change-password', ['token' => Cookie::get('token')])
    </div>
@endsection
