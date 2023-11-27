@extends('layouts.dashboard')

@section('title', 'Dashboard Operator')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush

@section('content')
    <div class="overflow-y-scroll" style="max-height: 85vh;">
        @livewire('queues-menus', ['user' => $user, 'token' => Cookie::get('token')])
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/main.js') }}"></script>
@endpush
