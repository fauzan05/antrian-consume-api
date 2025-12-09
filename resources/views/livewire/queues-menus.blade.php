<div>
    {{-- Counter Cards Section --}}
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-semibold mb-1 text-body">Counter Aktif</h5>
                <p class="small mb-0 text-body-secondary">Daftar counter yang sedang beroperasi</p>
            </div>
            <span class="badge rounded-pill bg-body-secondary text-body" style="font-weight: 500; padding: 8px 16px;">{{ count($counters) }} Counter</span>
        </div>

        <div class="row g-3">
            @forelse ($counters as $counter)
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="counter-card bg-body border rounded-3" style="padding: 24px; text-align: center; transition: all 0.2s ease;">
                        <div class="bg-body-secondary rounded-2" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                            <i class="fas fa-desktop text-body-secondary" style="font-size: 20px;"></i>
                        </div>
                        <h6 class="fw-semibold mb-2 text-body" style="font-size: 14px;">{{ $counter['name'] }}</h6>
                        <hr class="my-2">
                        <h4 class="fw-bold mb-0 text-success" style="font-size: 28px;">{{ $counter['number'] }}</h4>
                        <small class="text-body-secondary" style="font-size: 12px;">Nomor Antrian</small>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-circle me-3" style="font-size: 20px;"></i>
                        <div>Tidak ada counter tersedia saat ini</div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <hr class="my-4">

    {{-- Queue Information & List Section --}}
    <input id="counter_id" value="{{ $counter_id }}" type="hidden">

    <div class="row g-4">
        {{-- Queue Information Cards --}}
        <div class="col-lg-3">
            <div class="sticky-top" style="top: 100px;">
                <h5 class="fw-semibold mb-4 text-body">Statistik Antrian</h5>
                
                <div class="d-flex flex-column gap-3">
                    <div class="bg-body border rounded-3" style="padding: 20px;">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 rounded-2" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-users text-warning" style="font-size: 18px;"></i>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <small class="d-block mb-1 text-body-secondary" style="font-size: 12px; font-weight: 500;">Sisa Antrian</small>
                                <h4 class="mb-0 fw-bold text-body">{{ $remainQueue }}</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-body border rounded-3" style="padding: 20px;">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-2" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-clipboard-list text-primary" style="font-size: 18px;"></i>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <small class="d-block mb-1 text-body-secondary" style="font-size: 12px; font-weight: 500;">Total Antrian</small>
                                <h4 class="mb-0 fw-bold text-body">{{ $totalQueue }}</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-body border border-success border-2 rounded-3" style="padding: 20px;">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded-2" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user-check text-success" style="font-size: 18px;"></i>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <small class="d-block mb-1 text-success" style="font-size: 12px; font-weight: 600;">Sekarang</small>
                                <h4 class="mb-0 fw-bold text-success">{{ $currentQueue }}</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-body border rounded-3" style="padding: 20px;">
                        <div class="d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 rounded-2" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-clock text-info" style="font-size: 18px;"></i>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <small class="d-block mb-1 text-body-secondary" style="font-size: 12px; font-weight: 500;">Selanjutnya</small>
                                <h4 class="mb-0 fw-bold text-body">{{ $nextQueue }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        {{-- Queue List Table --}}
        <div class="col-lg-9">
            <div class="bg-body border rounded-3 overflow-hidden">
                <div class="border-bottom" style="padding: 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-semibold mb-1 text-body">Daftar Antrian</h5>
                            <p class="small mb-0 text-body-secondary">Kelola dan panggil antrian pasien</p>
                        </div>
                        <button style="background: linear-gradient(135deg, #52c234 0%, #38a169 100%); border: none; border-radius: 8px; padding: 8px 16px; font-size: 14px; font-weight: 500; color: #fff; transition: all 0.2s; box-shadow: 0 2px 4px rgba(82, 194, 52, 0.2);" wire:click="$refresh" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(82, 194, 52, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(82, 194, 52, 0.2)'">
                            <i class="fas fa-sync-alt me-2" style="font-size: 13px;"></i>Refresh
                        </button>
                    </div>
                </div>

                <div style="padding: 0;">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                            <thead>
                                <tr class="table-light">
                                    <th scope="col" class="text-center" style="width: 60px; padding: 16px; font-size: 13px; font-weight: 600; border: none;">No</th>
                                    <th scope="col" style="width: 140px; padding: 16px; font-size: 13px; font-weight: 600; border: none;">Nomor Antrian</th>
                                    <th scope="col" style="padding: 16px; font-size: 13px; font-weight: 600; border: none;">Jenis Layanan</th>
                                    <th scope="col" class="text-center" style="width: 140px; padding: 16px; font-size: 13px; font-weight: 600; border: none;">Status</th>
                                    <th scope="col" class="text-center" style="width: 120px; padding: 16px; font-size: 13px; font-weight: 600; border: none;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($queues['data'] ?? [] as $index => $queue)
                                    <tr class="queue-row border-bottom" style="transition: background 0.2s;">
                                        <td class="text-center text-body-secondary" style="padding: 16px; font-size: 14px;">{{ $index + 1 }}</td>
                                        <td style="padding: 16px;">
                                            <span class="badge bg-dark text-white" style="padding: 6px 14px; border-radius: 8px; font-weight: 600; font-size: 14px;">{{ $queue['number'] }}</span>
                                        </td>
                                        <td style="padding: 16px;">
                                            <div class="d-flex align-items-center">
                                                <span class="text-body" style="font-weight: 500; font-size: 14px;">{{ $queue['service_name'] }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center" style="padding: 16px;">
                                            @php
                                                $statusStyles = match(strtolower($queue['status'])) {
                                                    'waiting' => 'background: #fff3e0; color: #e65100; border: 1px solid #ffcc80;',
                                                    'called' => 'background: #e1f5fe; color: #01579b; border: 1px solid #81d4fa;',
                                                    'serving' => 'background: #e8eaf6; color: #283593; border: 1px solid #9fa8da;',
                                                    'done' => 'background: #e8f5e9; color: #1b5e20; border: 1px solid #81c784;',
                                                    default => 'background: #f5f5f5; color: #616161; border: 1px solid #e0e0e0;'
                                                };
                                            @endphp
                                            <span style="{{ $statusStyles }} padding: 6px 14px; border-radius: 8px; font-weight: 600; font-size: 12px; display: inline-block;">
                                                {{ ucfirst($queue['status']) }}
                                            </span>
                                        </td>
                                        <td class="text-center" style="padding: 16px;">
                                            <button 
                                                wire:click="calling('{{ $queue['id'] }}', '{{ $queue['number'] }}', '{{ $queue['service_name'] }}', '{{ $counter_id }}')"
                                                style="background: linear-gradient(135deg, #52c234 0%, #38a169 100%); border: none; color: #fff; padding: 8px 16px; border-radius: 8px; font-weight: 500; font-size: 13px; transition: all 0.2s; cursor: pointer; box-shadow: 0 2px 4px rgba(82, 194, 52, 0.2);"
                                                onmouseover="if(!this.disabled) { this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(82, 194, 52, 0.3)'; }"
                                                onmouseout="if(!this.disabled) { this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(82, 194, 52, 0.2)'; }"
                                                @if($isButtonDisabled) disabled @endif
                                                title="Panggil Antrian">
                                                <i class="fas fa-bullhorn me-2" style="font-size: 12px;"></i>Panggil
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="padding: 60px; text-align: center;">
                                            <div class="text-body-secondary">
                                                <i class="fas fa-inbox" style="font-size: 48px; opacity: 0.3; margin-bottom: 16px;"></i>
                                                <p style="margin: 0; font-size: 14px; font-weight: 500;">Tidak ada antrian tersedia</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination --}}
                @if (isset($queues['last_page']) && $queues['last_page'] > 1)
                    <div class="border-top" style="padding: 20px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-body-secondary" style="font-weight: 500;">
                                Halaman {{ $currentPage }} dari {{ $queues['last_page'] }}
                            </small>
                            <nav aria-label="Queue pagination">
                                <ul class="pagination pagination-sm mb-0" style="gap: 4px;">
                                    <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                        <a href="#" 
                                           wire:click.prevent="getPage({{ max(1, $currentPage - 1) }})" 
                                           class="btn btn-outline-secondary btn-sm rounded-2 text-body"
                                           style="padding: 6px 12px; border-radius: 8px; text-decoration: none; display: inline-block;">
                                            <i class="fas fa-chevron-left" style="font-size: 12px;"></i>
                                        </a>
                                    </li>
                                    
                                    @for ($i = 1; $i <= $queues['last_page']; $i++)
                                        @if ($i == 1 || $i == $queues['last_page'] || abs($i - $currentPage) <= 2)
                                            <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                                <a wire:click.prevent="getPage({{ $i }})" 
                                                   class="btn {{ $currentPage == $i ? 'btn-success' : 'btn-outline-secondary' }} btn-sm rounded-2 {{ $currentPage == $i ? 'text-white' : 'text-body' }}"
                                                   style="padding: 6px 12px; border-radius: 8px; text-decoration: none; display: inline-block; min-width: 36px; text-align: center; font-weight: 500; font-size: 13px; cursor: pointer;"
                                                   href="#">
                                                    {{ $i }}
                                                </a>
                                            </li>
                                        @elseif (abs($i - $currentPage) == 3)
                                            <li class="page-item disabled">
                                                <span class="text-body-secondary" style="padding: 6px 12px;">...</span>
                                            </li>
                                        @endif
                                    @endfor
                                    
                                    <li class="page-item {{ $currentPage == $queues['last_page'] ? 'disabled' : '' }}">
                                        <a href="#" 
                                           wire:click.prevent="getPage({{ min($queues['last_page'], $currentPage + 1) }})" 
                                           class="btn btn-outline-secondary btn-sm rounded-2 text-body"
                                           style="padding: 6px 12px; border-radius: 8px; text-decoration: none; display: inline-block;">
                                            <i class="fas fa-chevron-right" style="font-size: 12px;"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('css')
<style>
    .counter-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(82, 194, 52, 0.15) !important;
        border-color: var(--bs-success) !important;
    }
    
    .queue-row:hover {
        background: var(--bs-tertiary-bg) !important;
    }
    
    .pagination .page-item.active a {
        pointer-events: none;
    }
    
    .pagination .page-item.disabled a,
    .pagination .page-item.disabled span {
        opacity: 0.5;
        cursor: not-allowed !important;
        pointer-events: none;
    }
    
    button:disabled {
        opacity: 0.5;
        cursor: not-allowed !important;
    }
    
    /* Better btn outline hover in dark mode */
    [data-bs-theme="dark"] .btn-outline-secondary:hover:not(:disabled) {
        background-color: var(--bs-secondary) !important;
        border-color: var(--bs-secondary) !important;
        color: #fff !important;
    }
    
    /* Active pagination button */
    .btn-success {
        background: linear-gradient(135deg, #52c234 0%, #38a169 100%) !important;
        border-color: #52c234 !important;
    }
    
    .btn-success:hover {
        opacity: 0.9;
    }
</style>
@endpush