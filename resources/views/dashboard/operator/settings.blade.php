@extends('layouts.dashboard')

@section('title', 'Dashboard Operator')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush
@section('content')
<div class="d-flex justify-content-between align-items-center mt-5" style="height: 80%;">
    <div class="row m-2 d-flex justify-content-center align-items-center">
        <div class="col-10">
            <div class="card info-antrian shadow-sm text-center" style="width: 100%;">
                <div class="card-body rounded d-flex justify-content-center align-items-center">
                    <div class="col-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-10 py-4">
                                    <h3>Silahkan Masukkan Password Lama dan Password Baru Anda</h3>
                                </div>
                            </div>
                            <div class="col-10">
                                <img src="change-password.jpg" alt="" style="width: 100%;">
                            </div>
                        </div>
                    </div>
                    <div class="col-4 m-5">
                        <div class="col-12">
                            <form action="">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Password
                                        Lama</label>
                                    <input type="password" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Password
                                        Baru</label>
                                    <input type="password" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Verifikasi
                                        Password Baru</label>
                                    <input type="password" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <button type="submit" class="btn btn-primary mt-4 col-12">Ubah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script src="{{ asset('js/main.js') }}"></script>
@endpush
