<div>
    {{-- Statistics Cards --}}
    <div class="row g-3 mb-4">
        {{-- Pengunjung Hari Ini --}}
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div class="stat-icon flex-shrink-0">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="text-end flex-grow-1 ms-3">
                            <p class="text-body-secondary mb-1" style="font-size: 12px; font-weight: 500;">Pengunjung Hari Ini</p>
                            <h2 class="fw-bold mb-0 text-body" style="font-size: 32px;">{{ $queuesCount }}</h2>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <small class="text-success me-2">
                            <i class="fas fa-arrow-up me-1"></i> +12%
                        </small>
                        <small class="text-body-secondary">dari kemarin</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Layanan --}}
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div class="stat-icon flex-shrink-0">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="text-end flex-grow-1 ms-3">
                            <p class="text-body-secondary mb-1" style="font-size: 12px; font-weight: 500;">Total Layanan</p>
                            <h2 class="fw-bold mb-0 text-body" style="font-size: 32px;">{{ $servicesCount }}</h2>
                        </div>
                    </div>
                    <div>
                        <small class="text-body-secondary">Layanan aktif</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Loket --}}
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div class="stat-icon flex-shrink-0">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="text-end flex-grow-1 ms-3">
                            <p class="text-body-secondary mb-1" style="font-size: 12px; font-weight: 500;">Total Loket</p>
                            <h2 class="fw-bold mb-0 text-body" style="font-size: 32px;">{{ $countersCount }}</h2>
                        </div>
                    </div>
                    <div>
                        <small class="text-body-secondary">Loket tersedia</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Operator --}}
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div class="stat-icon flex-shrink-0">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="text-end flex-grow-1 ms-3">
                            <p class="text-body-secondary mb-1" style="font-size: 12px; font-weight: 500;">Total Operator</p>
                            <h2 class="fw-bold mb-0 text-body" style="font-size: 32px;">{{ $usersCount }}</h2>
                        </div>
                    </div>
                    <div>
                        <small class="text-body-secondary">Operator terdaftar</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Section --}}
    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-semibold mb-0 text-body">Data Statistik Pengunjung</h6>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-secondary active">Harian</button>
                            <button type="button" class="btn btn-outline-secondary">Bulanan</button>
                            <button type="button" class="btn btn-outline-secondary">Tahunan</button>
                        </div>
                    </div>
                    <div style="position: relative; height: 250px;">
                        <canvas id="visitorChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <h6 class="fw-semibold mb-3 text-body">Respon Pengunjung</h6>
                    <div style="position: relative; height: 250px;">
                        <canvas id="responseChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Tables --}}
    <div class="row g-3">
        {{-- Antrian Terkini --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-0">
                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                        <h6 class="fw-semibold mb-0 text-body">Antrian Terkini</h6>
                        <span class="badge bg-success-subtle text-success">
                            <i class="fas fa-circle" style="font-size: 6px;"></i> Live
                        </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">No</th>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">Loket</th>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">Nomor</th>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($currentQueues as $index => $queue)
                                    <tr>
                                        <td class="text-body-secondary" style="padding: 12px 16px; font-size: 13px;">{{ $index + 1 }}</td>
                                        <td class="text-body fw-medium" style="padding: 12px 16px; font-size: 13px;">{{ $queue['name'] ?? '-' }}</td>
                                        <td style="padding: 12px 16px;">
                                            <span class="badge bg-dark text-white" style="font-size: 11px;">{{ $queue['number'] ?? '-' }}</span>
                                        </td>
                                        <td style="padding: 12px 16px;">
                                            @php
                                                $statusClass = match($queue['status'] ?? '') {
                                                    'serving' => 'bg-success',
                                                    'called' => 'bg-primary',
                                                    'waiting' => 'bg-warning',
                                                    default => 'bg-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}" style="font-size: 11px;">
                                                {{ ucfirst($queue['status'] ?? '-') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-body-secondary py-5">
                                            <i class="fas fa-inbox mb-2" style="font-size: 32px; opacity: 0.3;"></i>
                                            <p class="mb-0" style="font-size: 13px;">Tidak ada antrian saat ini</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Daftar Layanan --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-0">
                    <div class="p-3 border-bottom">
                        <h6 class="fw-semibold mb-0 text-body">Daftar Layanan</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">No</th>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">Nama</th>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">Bagian</th>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">Inisial</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($services as $index => $service)
                                    <tr>
                                        <td class="text-body-secondary" style="padding: 12px 16px; font-size: 13px;">{{ $index + 1 }}</td>
                                        <td class="text-body fw-medium" style="padding: 12px 16px; font-size: 13px;">{{ $service['name'] }}</td>
                                        <td class="text-body-secondary" style="padding: 12px 16px; font-size: 13px;">{{ $service['department'] ?? '-' }}</td>
                                        <td style="padding: 12px 16px;">
                                            <span class="badge bg-success-subtle text-success" style="font-size: 11px;">{{ $service['initial'] }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-body-secondary py-5">
                                            <i class="fas fa-inbox mb-2" style="font-size: 32px; opacity: 0.3;"></i>
                                            <p class="mb-0" style="font-size: 13px;">Belum ada layanan</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Daftar Operator --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-0">
                    <div class="p-3 border-bottom">
                        <h6 class="fw-semibold mb-0 text-body">Daftar Operator</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">No</th>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">Nama</th>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">Username</th>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">Bagian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $index => $user)
                                    <tr>
                                        <td class="text-body-secondary" style="padding: 12px 16px; font-size: 13px;">{{ $index + 1 }}</td>
                                        <td class="text-body fw-medium" style="padding: 12px 16px; font-size: 13px;">{{ $user['name'] }}</td>
                                        <td class="text-body-secondary" style="padding: 12px 16px; font-size: 13px;">{{ $user['username'] }}</td>
                                        <td style="padding: 12px 16px;">
                                            <span class="badge bg-primary" style="font-size: 11px;">{{ $user['department'] ?? 'General' }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-body-secondary py-5">
                                            <i class="fas fa-inbox mb-2" style="font-size: 32px; opacity: 0.3;"></i>
                                            <p class="mb-0" style="font-size: 13px;">Belum ada operator</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Daftar Loket --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-0">
                    <div class="p-3 border-bottom">
                        <h6 class="fw-semibold mb-0 text-body">Daftar Loket</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">No</th>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">Loket</th>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">Operator</th>
                                    <th class="text-body-secondary" style="font-size: 12px; font-weight: 600; padding: 12px 16px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($counters as $index => $counter)
                                    <tr>
                                        <td class="text-body-secondary" style="padding: 12px 16px; font-size: 13px;">{{ $index + 1 }}</td>
                                        <td class="text-body fw-medium" style="padding: 12px 16px; font-size: 13px;">{{ $counter['name'] }}</td>
                                        <td class="text-body-secondary" style="padding: 12px 16px; font-size: 13px;">{{ $counter['user_name'] ?? 'Tidak ada' }}</td>
                                        <td style="padding: 12px 16px;">
                                            <span class="badge {{ ($counter['is_available'] ?? false) ? 'bg-success' : 'bg-secondary' }}" style="font-size: 11px;">
                                                {{ ($counter['is_available'] ?? false) ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-body-secondary py-5">
                                            <i class="fas fa-inbox mb-2" style="font-size: 32px; opacity: 0.3;"></i>
                                            <p class="mb-0" style="font-size: 13px;">Belum ada loket</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Visitor Chart
        const visitorCtx = document.getElementById('visitorChart');
        if (visitorCtx) {
            new Chart(visitorCtx, {
                type: 'line',
                data: {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    datasets: [{
                        label: 'Pengunjung',
                        data: [12, 19, 15, 25, 22, 18, 15],
                        borderColor: '#52c234',
                        backgroundColor: 'rgba(82, 194, 52, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#52c234',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 13
                            },
                            bodyFont: {
                                size: 12
                            },
                            cornerRadius: 8
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        }

        // Response Chart
        const responseCtx = document.getElementById('responseChart');
        if (responseCtx) {
            new Chart(responseCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Sangat Puas', 'Puas', 'Cukup', 'Kurang'],
                    datasets: [{
                        data: [45, 30, 20, 5],
                        backgroundColor: [
                            '#52c234',
                            '#38a169',
                            '#fbbf24',
                            '#ef4444'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                font: {
                                    size: 11
                                },
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 13
                            },
                            bodyFont: {
                                size: 12
                            },
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.parsed + '%';
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
