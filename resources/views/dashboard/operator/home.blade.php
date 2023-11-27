@extends('layouts.dashboard')

@section('title', 'Dashboard Operator')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush

@section('content')
    <div class="overflow-y-scroll" style="max-height: 85vh;">
        <div class="row m-2 d-flex flex-column justify-content-center align-items-center">
            <div class="col-12 m-3">
                @livewire('counter-queue-status')
            </div>
            <hr>
            @livewire('queues-menus', ['token' => Cookie::get('token')])
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/main.js') }}"></script>
@endpush
