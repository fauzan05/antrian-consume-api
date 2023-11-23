@extends('layouts.app')

@section('title', 'Unprocessable User')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush
@section('content')
    <div class="d-flex text-center justify-content-center align-items-center" style="height: 100vh">
        <h3>{{ $data }}</h3>
    </div>
@endsection