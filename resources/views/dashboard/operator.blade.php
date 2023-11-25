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
                  @livewire('information-queue-status')
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