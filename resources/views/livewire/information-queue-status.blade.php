<div class="row d-flex flex-column justify-content-center align-items-center">
    <div class="col-12 text-center mb-3">
      <h3>Informasi</h3>
    </div>
    <div class="col-12 m-3">
      <div class="card info-antrian shadow-sm text-center" style="width: 100%;">
        <div class="card-body">
          <h5>Sisa Antrian <i class="fa-solid fa-user-group"></i></h5>
          <hr>
          <h5>{{ $remainQueue }}</h5>
        </div>
      </div>
    </div>
    <div class="col-12 m-3">
      <div class="card info-antrian shadow-sm text-center" style="width: 100%;">
        <div class="card-body">
          <h5>Jumlah Antrian <i class="fa-solid fa-user-pen"></i></h5>
          <hr>
          <h5>{{ $totalQueue }}</h5>
        </div>
      </div>
    </div>
    <div class="col-12 m-3">
      <div class="card info-antrian shadow-sm text-center" style="width: 100%;">
        <div class="card-body">
          <h5>Antrian Sekarang <i class="fa-solid fa-user-check"></i></h5>
          <hr>
          <h5>{{ $currentQueue }}</h5>
        </div>
      </div>
    </div>
    <div class="col-12 m-3">
      <div class="card info-antrian shadow-sm text-center" style="width: 100%;">
        <div class="card-body">
          <h5>Antrian Selanjutnya <i class="fa-solid fa-user-clock"></i></h5>
          <hr>
          <h5>{{ $nextQueue }}</h5>
        </div>
      </div>
    </div>
  </div>