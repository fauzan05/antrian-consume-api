<div class="col-12 content">
    {{-- <input type="hidden" name="token" data-csrf="{{csrf_token()}}" value="{{ csrf_token() }}"> --}}
    <div class="container-fluid container-content">
        <div class="row no-gutters gap-3">
            <div class="col-12">
                <div class="sub-title m-2">
                    <div class="d-flex flex-column">
                        <span class="text-title">Menu Layanan</span>
                        <span class="text-sub-title">Menampilkan informasi data dan konfigurasi layanan</span>
                    </div>
                    @if (session('status'))
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="alert alert-success text-center" role="alert" style="width: 80%;">
                                {{ session('status')['message'] }}
                            </div>
                        </div>
                    @endif
                    <button id="createCounter" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createModalCounter">Buat Layanan<br><i
                            class="fa-solid fa-clipboard-list icon"></i> +
                    </button>
                </div>
                <hr style="color: var(--text-color)">
                <div class="cards-box gap-3">
                    @if (!$services)
                        <div class="alert alert-danger" role="alert">
                            <span class="text-sub-title"><i class="fa-solid fa-triangle-exclamation"></i> Layanan belum
                                tersedia/dibuat (kosong)</span>
                        </div>
                    @else
                        @foreach ($services as $item)
                            <div class="card shadow-sm">
                                <i class="fa-solid fa-clipboard-list icon me-3"></i>
                                <div class="d-flex gap-2 flex-column justify-content-center align-items-start">
                                    <span class="text-1">{{ $item['initial'] }}</span>
                                    <span class="text-2">{{ $item['name'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-12">
                <div class="sub-title m-2">
                    <div class="d-flex flex-column">
                        <span class="text-sub-title">Pengaturan konfigurasi layanan</span>
                    </div>
                </div>
                <div class="row no-gutters d-flex justify-content-center">
                    <div class="col-6">
                        <div class="card information-card-lists">
                            <span class="ms-4 mt-3 text">Daftar Layanan</span>
                            <hr class="mx-3">
                            <div class="lists no-gutters gap-3">
                                @if (!$services)
                                    <div class="alert alert-danger" role="alert">
                                        <span class="text-sub-title"><i class="fa-solid fa-triangle-exclamation"></i>
                                            Layanan belum tersedia/dibuat (kosong)</span>
                                    </div>
                                @else
                                    @foreach ($services as $item)
                                        <div class="list">
                                            <div class="d-flex flex-row gap-2">
                                                <i class="fa-solid fa-clipboard-list icon"></i>
                                                <div class="d-flex flex-column">
                                                    <span class="text">{{ $item['name'] }}</span>
                                                    <span class="text-sub">Bagian :
                                                        {{ $item['role'] == 'registration' ? 'Pendaftaran' : 'Poli' }}</span>
                                                </div>
                                            </div>
                                            <div class="button d-flex align-items-center">
                                                <button
                                                    wire:click="editService('{{ $item['id'] }}', '{{ $item['name'] }}', '{{ $item['role'] }}', '{{ $item['initial'] }}','{{ $item['description'] }}')"
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
                            <span class="ms-4 mt-3 text">Edit Layanan</span>
                            <hr class="mx-3">
                            @if ($isEdit)
                                <livewire:service-edit-form :service="$currentService" :token="$token">
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
    <!-- Modal -->
    <div class="modal fade" id="createModalCounter" tabindex="-1" aria-labelledby="createModalCounter"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: var(--sidebar-color)">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: var(--text-color)">Membuat Layanan
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="color: red"></button>
                </div>
                <div class="modal-body">
                    <livewire:service-create-form :token="$token">
                </div>
            </div>
        </div>
    </div>
</div>
