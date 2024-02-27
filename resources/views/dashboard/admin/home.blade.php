@extends('layouts.admin-dashboard')

@section('title', 'Dashboard Admin')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
@php
$token = Cookie::get('token');
$darkMode = Cookie::get('dark-mode');
@endphp
<livewire:menu-controller :user=$user :token=$token :darkMode="$darkMode">
@endsection

