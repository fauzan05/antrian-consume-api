@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush

@section('content')
    <livewire:get-counter/>
@endsection

@push('js')
    <script src="{{ asset('js/main.js') }}"></script>
@endpush
