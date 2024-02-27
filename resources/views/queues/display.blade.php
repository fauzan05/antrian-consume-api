@push('css')
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush
@extends('layouts.queues')
@section('title', 'Display Antrian')
@section('content')
    <livewire:queues-display>
@endsection