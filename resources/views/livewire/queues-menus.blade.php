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
    <input id="counter_id" value="{{ $counter_id }}" hidden>
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
                                <h5>{{ $nextQueue }}</h5>
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
                                $i = 1
                            @endphp
                            @if($queues['data'] != null)
                            @foreach ($queues['data'] as $item)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $item['number'] }}</td>
                                    <td>{{ $item['service_name'] }}</td>
                                    <td>{{ $item['status'] }}</td>
                                    <td><button href="#" id="{{ $counter_id }}"
                                            wire:click="calling('{{ $item['id'] }}', '{{ $item['number'] }}', '{{ $item['service_name'] }}', '{{ $counter_id }}')"
                                            role="button" type="button" class="btn ms-4 panggil" style="color: red"
                                            x-bind:disabled="{{ $isButtonDisabled }}">
                                            <i class="fa-solid fa-microphone"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-3 d-flex align-items-center justify-content-center">
                    @php
                            if($queues['last_page'] != null):
                    @endphp
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item {{ ($currentPage == 1) ? 'disabled' : '' }}" id="previous">
                                <a href="#" wire:click.prevent="getPage('{{ $currentPage == 1 ? 1 : $currentPage-1 }}')" class="page-link">Sebelumnya</a>
                            </li>
                            
                            @for ($i = 1; $i <= $queues['last_page']; $i++)
                                <li class="page-item index-page {{($currentPage == $i) ? 'active' : ''}}" >
                                    <a id="{{ $i }}" wire:click.prevent="getPage({{ $i }})" class="page-link"
                                        href="#">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ ($currentPage == $queues['last_page']) ? 'disabled' : '' }}" id="next">
                                <a href="#" wire:click.prevent="getPage('{{ $currentPage == $queues['last_page'] ? $queues['last_page'] : $currentPage+1 }}')" class="page-link">Selanjutnya</a>
                            </li>
                        </ul>
                    </nav>
                    @php
                    endif;
                            @endphp
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
</div>