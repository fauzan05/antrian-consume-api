@extends('layouts.admin-dashboard')

@section('title', 'Dashboard Admin')

@section('content')
    <livewire:admin-dashboard :user="$user">
@endsection

