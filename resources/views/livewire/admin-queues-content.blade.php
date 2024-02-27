<div class="col-12 content">
    <div class="container-fluid container-content">
        <div class="row no-gutters gap-3">
            <div class="col-12">
                <div class="sub-title m-2">
                    <div class="d-flex flex-column">
                        <span class="text-title">Menu Antrian</span>
                        <span class="text-sub-title">Menampilkan informasi data dan antrian terkini sesuai masing-masing loket</span>
                    </div>
                    @if (session('status'))
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="alert alert-success text-center" role="alert" style="width: 80%;">
                                {{ session('status')['message'] }}
                            </div>
                        </div>
                    @endif
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
        </div>
    </div>
</div>
