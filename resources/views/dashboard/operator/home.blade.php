@extends('layouts.app')

@section('title', 'Dashboard Operator')

@section('content')
    @livewire('operator-dashboard', ['user' => $user])
@endsection
