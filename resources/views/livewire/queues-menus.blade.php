<div class="row m-2 d-flex flex-column justify-content-center align-items-center">
    <div class="col-12 m-3">
        <div class="row d-flex flex-row justify-content-center align-items-center">
            @foreach ($counters as $item)
                <div class="col-2 m-3">
                    <div class="card shadow-click bg-success text-center" style="width: 100%;">
                        <div class="card-body">
                            <h3 class="card-text">{{ $item['name'] }}</h3>
                            <hr>
                            <h4>{{ $item['number'] }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8 m-3 d-flex flex-column">
                <div class="col-12 mb-4 text-center">
                    <h3>List Antrian</h3>
                </div>
                <div class="col-12">
                    <table class="table align-middle table-responsive table-hover shadow-sm">
                        <thead>
                            <tr class="table-active">
                                <th scope="col">No</th>
                                <th scope="col">Nomor Antrian</th>
                                <th scope="col">Jenis Layanan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Panggil</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($queues as $item)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $item['number'] }}</td>
                                    <td>{{ $item['service_name'] }}</td>
                                    <td>{{ $item['status'] }}</td>
                                    <td><button href="#"
                                            wire:click="calling({{ $item['id'] }}, '{{ $item['number'] }}', '{{ $item['service_name'] }}')"
                                            wire:loading.attr="disabled" role="button" type="button" class="btn ms-4"
                                            style="color: red">
                                            <i class="fa-solid fa-microphone"></i>
                                            <span wire:loading>...</span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
</div>
