<div class="col-12 content">
    <div class="container-fluid container-content">
        <div class="row no-gutters gap-3">
            <div class="col-12">
                <div class="sub-title m-2">
                    <div class="d-flex flex-column">
                        <span class="text-title">Menu Operator</span>
                        <span class="text-sub-title">Menampilkan informasi data dan konfigurasi operator</span>
                    </div>
                    @if (session('status'))
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="alert alert-success text-center" role="alert" style="width: 80%;">
                                {{ session('status')['message'] }}
                            </div>
                        </div>
                    @endif
                    <button id="createCounter" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createModalCounter">Buat Operator<br><i class="fa-solid fa-user icon"></i> +
                    </button>
                </div>
                <hr style="color: var(--text-color)">
                <div class="cards-box gap-3">
                    @if (!$users)
                        <div class="alert alert-danger" role="alert">
                            <span class="text-sub-title"><i class="fa-solid fa-triangle-exclamation"></i> Operator belum
                                tersedia/dibuat (kosong)</span>
                        </div>
                    @else
                        @foreach ($users as $item)
                            <div class="card shadow-sm">
                                <i class="fa-solid fa-user icon me-3"></i>
                                <div class="d-flex gap-2 flex-column justify-content-center align-items-start">
                                    <span class="text-1">{{ $item['name'] }}</span>
                                    <span class="text-2">{{ $item['username'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-12">
                <div class="sub-title m-2">
                    <div class="d-flex flex-column">
                        <span class="text-sub-title">Pengaturan konfigurasi operator</span>
                    </div>
                </div>
                <div class="row no-gutters d-flex justify-content-center">
                    <div class="col-6">
                        <div class="card information-card-lists">
                            <span class="ms-4 mt-3 text">Daftar Operator</span>
                            <hr class="mx-3">
                            <div class="lists no-gutters gap-3">
                                @if (!$users)
                                    <div class="alert alert-danger" role="alert">
                                        <span class="text-sub-title"><i class="fa-solid fa-triangle-exclamation"></i>
                                            Operator belum tersedia/dibuat (kosong)</span>
                                    </div>
                                @else
                                    @foreach ($users as $item)
                                        <div class="list">
                                            <div class="d-flex flex-row gap-2">
                                                <i class="fa-solid fa-user icon"></i>
                                                <div class="d-flex flex-column">
                                                    <span class="text">{{ $item['name'] }}</span>
                                                    <span class="text-sub">Username :
                                                        {{ $item['username'] }}</span>
                                                </div>
                                            </div>
                                            <div class="button d-flex align-items-center">
                                                <button
                                                    wire:click="editUser('{{ $item['id'] }}', '{{ $item['name'] }}', '{{ $item['username'] }}')"
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
                            <span class="ms-4 mt-3 text">Edit Operator</span>
                            <hr class="mx-3">
                            @if ($isEdit)
                                <livewire:user-edit-form :user="$currentUser" :token="$token">
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
    <!-- Modal Create -->
    <div class="modal fade" id="createModalCounter" tabindex="-1" aria-labelledby="createModalCounter"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: var(--sidebar-color)">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: var(--text-color)">Membuat
                        Operator
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="color: red"></button>
                </div>
                <div class="modal-body">
                    <livewire:user-create-form :token="$token">
                </div>
            </div>
        </div>
    </div>
</div>
