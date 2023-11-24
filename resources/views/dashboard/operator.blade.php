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
            <div class="col-12">
              <div class="row d-flex flex-row justify-content-center align-items-start">
                <div class="col-3 m-3">
                  <div class="row d-flex flex-column justify-content-center align-items-center">
                    <div class="col-12 text-center mb-3">
                      <h3>Informasi</h3>
                    </div>
                    <div class="col-12 m-3">
                      <div class="card info-antrian shadow-sm text-center" style="width: 100%;">
                        <div class="card-body">
                          <h5>Sisa Antrian <i class="fa-solid fa-user-group"></i></h5>
                          <hr>
                          <h5>45</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 m-3">
                      <div class="card info-antrian shadow-sm text-center" style="width: 100%;">
                        <div class="card-body">
                          <h5>Jumlah Antrian <i class="fa-solid fa-user-pen"></i></h5>
                          <hr>
                          <h5>109</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 m-3">
                      <div class="card info-antrian shadow-sm text-center" style="width: 100%;">
                        <div class="card-body">
                          <h5>Antrian Sekarang <i class="fa-solid fa-user-check"></i></h5>
                          <hr>
                          <h5>12</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 m-3">
                      <div class="card info-antrian shadow-sm text-center" style="width: 100%;">
                        <div class="card-body">
                          <h5>Antrian Selanjutnya <i class="fa-solid fa-user-clock"></i></h5>
                          <hr>
                          <h5>13</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-8 m-3 d-flex flex-column">
                  <div class="row">
                    <div class="col-12 mb-4 text-center">
                      <h3>List Antrian</h3>
                    </div>
                    @livewire('show-queue-table', ['idUser' => $user['data']['id']])
                  </div>               
                </div>
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