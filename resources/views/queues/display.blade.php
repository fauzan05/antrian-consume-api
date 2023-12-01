@extends('layouts.queues')
@section('title', 'Display Antrian')
@push('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush
@section('content')
    @livewire('queues-display')
@endsection