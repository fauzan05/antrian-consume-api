<div class="col-12 content">
    {{-- <input type="hidden" name="token" data-csrf="{{csrf_token()}}" value="{{ csrf_token() }}"> --}}
    <div class="container-fluid container-content">
        <div class="row no-gutters gap-3">
            <div class="col-12">
                <div class="sub-title m-2">
                    <div class="d-flex flex-column">
                        <span class="text-title">Menu Loket</span>
                        <span class="text-sub-title">Menampilkan informasi data dan konfigurasi loket </span>
                    </div>
                    @if (session('status'))
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="alert alert-success text-center" role="alert" style="width: 80%;">
                                {{ session('status')['message'] }}
                            </div>
                        </div>
                    @endif
                    <button type="button" id="createCounter" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createModalCounter">Buat Loket <br><i class="fa-solid fa-headset icon"></i> +
                    </button>
                </div>
                <hr style="color: var(--text-color)">
                <div class="cards-box gap-3">
                    @if (!$counters)
                        <div class="alert alert-danger" role="alert">
                            <span class="text-sub-title"><i class="fa-solid fa-triangle-exclamation"></i> Loket belum
                                tersedia/dibuat (kosong)</span>
                        </div>
                    @else
                        @foreach ($counters as $key => $counter)
                            <div class="card shadow-sm">
                                <i class="fa-solid fa-headset icon me-3"></i>
                                <div class="d-flex gap-2 flex-column justify-content-center align-items-start">
                                    <span class="text-1">{{ $counter['name'] }}</span>
                                    <span class="text-2">{{ $counter['service']['name'] ?? "(kosong)" }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-12">
                <div class="sub-title m-2">
                    <div class="d-flex flex-column">
                        <span class="text-sub-title">Pengaturan konfigurasi loket </span>
                    </div>
                </div>
                <div class="row no-gutters d-flex justify-content-center">
                    <div class="col-6">
                        <div class="card information-card-lists">
                            <span class="ms-4 mt-3 text">Daftar Loket</span>
                            <hr class="mx-3">
                            <div class="lists no-gutters gap-3">
                                @if (!$counters)
                                    <div class="alert alert-danger" role="alert">
                                        <span class="text-sub-title"><i class="fa-solid fa-triangle-exclamation"></i>
                                            Loket belum tersedia/dibuat (kosong)</span>
                                    </div>
                                @else
                                    @foreach ($counters as $key => $counter)
                                        <div class="list">
                                            <div class="d-flex flex-row gap-2">
                                                <i class="fa-solid fa-headset icon"></i>
                                                <div class="d-flex flex-column">
                                                    <span class="text">{{ $counter['name'] }}</span>
                                                    <span class="text-sub">Operator :
                                                        {{ $counter['operator']['name'] }}</span>
                                                </div>
                                            </div>
                                            <div class="button d-flex align-items-center">
                                                <button
                                                    wire:click="editCounter('{{ $counter['id'] }}', '{{ $counter['name'] }}', '{{ $counter['service']['id'] ?? null }}', '{{ $counter['operator']['id'] }}', '{{ $counter['is_active'] }}')"
                                                    class="btn btn-outline-danger btn-sm">Edit</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card information-card-edits">
                            <span class="ms-4 mt-3 text">Edit Loket</span>
                            <hr class="mx-3">
                            @if ($isEdit)
                                <livewire:counter-edit-form :currentDataEdit="$currentDataEdit" :token="$token">
                                @else
                                    <div class="d-flex justify-content-center align-items-center mx-3 mb-3"
                                        style="height: 100%">
                                        <span class="blank">Tekan tombol "Edit" untuk mengubah</span>
                                    </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Create Counter-->
    <div class="modal fade" id="createModalCounter" tabindex="-1" aria-labelledby="createModalCounter"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Membuat Loket
                    </h1>
                    <button type="button" wire:click="flush()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="color: red"></button>
                </div>
                <div class="modal-body">
                    <livewire:counter-create-form :dataCreate="$dataCreate" :token="$token">
                </div>
            </div>
        </div>
    </div>
</div>
