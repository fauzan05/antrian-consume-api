<div>
    {{-- Success Message --}}
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('status')['message'] }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h6 class="fw-semibold mb-1 text-body">Daftar Loket</h6>
            <small class="text-body-secondary">Kelola loket dan operator yang bertugas</small>
        </div>
        <button type="button" class="btn btn-success d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createModalCounter" style="border-radius: 8px;">
            <i class="fas fa-plus"></i>
            <span>Tambah Loket</span>
        </button>
    </div>

    {{-- Counters Grid --}}
    @if (!$counters || count($counters) === 0)
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-inbox text-body-secondary mb-3" style="font-size: 48px; opacity: 0.3;"></i>
                <p class="text-body-secondary mb-0">Belum ada loket yang dibuat</p>
                <small class="text-body-secondary">Klik tombol "Tambah Loket" untuk membuat loket baru</small>
            </div>
        </div>
    @else
        <div class="row g-3">
            @foreach ($counters as $counter)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 counter-card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="counter-icon">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 28px; height: 28px; padding: 0; border-radius: 6px;">
                                        <i class="fas fa-ellipsis-v" style="font-size: 12px;"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="min-width: 120px;">
                                        <li>
                                            <a class="dropdown-item py-2" href="#" 
                                               wire:click.prevent="editCounter('{{ $counter['id'] }}', '{{ $counter['name'] }}', '{{ $counter['service']['id'] ?? '' }}', '{{ $counter['operator']['id'] ?? '' }}', '{{ $counter['is_active'] }}')"
                                               data-bs-toggle="modal" 
                                               data-bs-target="#editModalCounter"
                                               style="font-size: 13px; width: 110px !important;">
                                                <i class="fas fa-edit me-2 text-primary" style="width: 14px !important; font-size: 12px;"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 text-danger" href="#" 
                                               wire:click.prevent="selectCounter('{{ $counter['id'] }}', '{{ $counter['name'] }}')"
                                               data-bs-toggle="modal" 
                                               data-bs-target="#deleteModalCounter"
                                               style="font-size: 13px; width: 110px !important;">
                                                <i class="fas fa-trash me-2" style="width: 14px; font-size: 12px;"></i> Hapus
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <h6 class="fw-semibold mb-2 text-body" style="font-size: 15px;">{{ $counter['name'] }}</h6>
                            
                            <div class="mb-2">
                                <small class="text-body-secondary d-block mb-1" style="font-size: 11px;">Layanan:</small>
                                <span class="badge bg-primary-subtle text-primary" style="font-size: 11px;">
                                    {{ $counter['service']['name'] ?? 'Belum ada' }}
                                </span>
                            </div>
                            
                            <div class="mb-2">
                                <small class="text-body-secondary d-block mb-1" style="font-size: 11px;">Operator:</small>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-user-circle text-body-secondary" style="font-size: 14px;"></i>
                                    <span class="text-body" style="font-size: 12px;">{{ $counter['operator']['name'] ?? 'Belum ditugaskan' }}</span>
                                </div>
                            </div>
                            
                            <div class="pt-2 border-top mt-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <small class="text-body-secondary" style="font-size: 11px;">Status</small>
                                    <span class="badge {{ $counter['is_active'] ? 'bg-success' : 'bg-secondary' }}" style="font-size: 10px;">
                                        {{ $counter['is_active'] ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Modal Create Counter --}}
    <div class="modal fade" id="createModalCounter" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="modal-title fw-semibold text-body" style="font-size: 18px;">Tambah Loket Baru</h5>
                        <small class="text-body-secondary">Isi form untuk menambah loket</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    @livewire('counter-create-form', ['dataCreate' => $dataCreate, 'token' => $token])
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Counter --}}
    <div class="modal fade" id="editModalCounter" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="modal-title fw-semibold text-body" style="font-size: 18px;">Edit Loket</h5>
                        <small class="text-body-secondary">Ubah informasi loket</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    @if($isEdit && $currentDataEdit)
                        @livewire('counter-edit-form', ['currentDataEdit' => $currentDataEdit, 'token' => $token], key('edit-counter-'.$counterId))
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Delete Counter --}}
    <div class="modal fade" id="deleteModalCounter" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-semibold text-body" style="font-size: 16px;">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-body-secondary mb-0" style="font-size: 14px;">
                        Apakah Anda yakin ingin menghapus loket <strong class="text-body">{{ $selectedCounterName ?? '' }}</strong>?
                    </p>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="button" wire:click="deleteCounter" class="btn btn-danger" data-bs-dismiss="modal" style="border-radius: 8px;">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
<style>
    .counter-card {
        transition: all 0.2s ease;
    }
    
    .counter-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
    }
    
    .counter-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, #52c234 0%, #38a169 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(82, 194, 52, 0.2);
    }
    
    .counter-icon i {
        color: white;
        font-size: 20px;
    }
    
    .dropdown-menu {
        border-radius: 10px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.08);
        padding: 6px;
    }
    
    [data-bs-theme="dark"] .dropdown-menu {
        border-color: rgba(255, 255, 255, 0.1);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
    }
    
    .dropdown-item {
        border-radius: 6px;
        margin: 0;
        transition: all 0.15s ease;
        padding: 8px 12px;
    }
    
    .dropdown-item:hover {
        background: rgba(82, 194, 52, 0.1);
    }
    
    .dropdown-item.text-danger:hover {
        background: rgba(220, 53, 69, 0.1);
    }
    
    .modal-content {
        border-radius: 16px;
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('close-modal', (event) => {
            const modalId = event[0] || event;
            const modal = document.getElementById(modalId);
            if (modal) {
                const bsModal = bootstrap.Modal.getInstance(modal);
                if (bsModal) {
                    bsModal.hide();
                }
                // Remove backdrop manually if still exists
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }
                // Reset body scroll
                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('overflow');
                document.body.style.removeProperty('padding-right');
            }
        });
    });
</script>
@endpush

