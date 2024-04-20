<div class="col-12 content">
    <div class="container-fluid container-content">
        <div class="row container-row gap-3">
            <div class="col-12">
                <div class="sub-title m-2">
                    <div class="d-flex flex-column">
                        <span class="text-title">Menu Dashboard</span>
                        <span class="text-sub-title">Menampilkan data dan statistik antrian</span>
                    </div>
                    <span class="text-title">Selamat Datang Admin!</span>
                </div>
                <hr style="color: var(--text-color)">
                <div class="cards-box">
                    <div class="card shadow-sm">
                        <span class="text-total me-3 ms-3">{{ $queuesCount }}</span>
                        <div class="d-flex gap-3 flex-column justify-content-center align-items-center">
                            <i class="fa-solid fa-users icon"></i>
                            <span class="text-info">Pengunjung Hari Ini</span>
                        </div>
                    </div>
                    <div class="card shadow-sm gap-3">
                        <span class="text-total">{{ $servicesCount }}</span>
                        <div class="d-flex gap-3 flex-column justify-content-center align-items-center">
                            <i class="fa-solid fa-clipboard-list icon"></i>
                            <span class="text-info">Layanan</span>
                        </div>
                    </div>
                    <div class="card shadow-sm gap-3">
                        <span class="text-total">{{ $countersCount }}</span>
                        <div class="d-flex gap-3 flex-column justify-content-center align-items-center">
                            <i class="fa-solid fa-headset icon"></i>
                            <span class="text-info">Loket</span>
                        </div>
                    </div>
                    <div class="card shadow-sm gap-3">
                        <span class="text-total">{{ $usersCount }}</span>
                        <div class="d-flex gap-3 flex-column justify-content-center align-items-center">
                            <i class="fa-solid fa-user icon"></i>
                            <span class="text-info">Operator</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="sub-title m-3">
                    <div class="d-flex flex-column">
                        <span class="text-sub-title">Data statistik pengunjung</span>
                    </div>
                </div>
                <hr>
                <div class="chart-wrapper gap-3">
                    <div class="card shadow-sm line-chart-container">
                        <i id="left-button" class="fa-solid fa-chevron-left"></i>
                        <div class="line-chart-carausel">
                            <div class="line-chart">
                                <span class="text text-center rounded">Data Harian</span>
                                <canvas id="myChart1"></canvas>
                            </div>
                            <div class="line-chart">
                                <span class="text text-center rounded">Data Bulanan</span>
                                <canvas id="myChart2"></canvas>
                            </div>
                            <div class="line-chart">
                                <span class="text text-center rounded">Data Tahunan</span>
                                <canvas id="myChart3"></canvas>
                            </div>
                        </div>
                        <i id="right-button" class="fa-solid fa-chevron-right"></i>
                    </div>
                    <div class="card shadow-sm pie-chart-container">
                        <div class="pie-chart">
                            <span class="text mb-4 text-center rounded">Respon Pengunjung</span>
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                    <div class="card shadow-sm polar-chart-container">
                        <div class="polar-chart">
                            <span class="text mb-4 text-center rounded">Pengunjung Poli</span>
                            <canvas id="polarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="sub-title m-3">
                    <div class="d-flex flex-column">
                        <span class="text-sub-title">Informasi</span>
                    </div>
                </div>
                <hr>
                <div class="cards-box-2 gap-3">
                    <div class="card" style="height: 70vh; width:100%;">
                        <span class="ms-4 mt-3 text-title-sm">Antrian Terkini</span>
                        <hr class="mx-3">
                        <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                            <table class="table table-admin-dashboard text-center mt-3 table-striped table-hover">
                                <thead class="thead-admin-dashboard">
                                    <tr class="table-active" style="color: var(--text-icon-color) !important;">
                                        <th scope="col">No</th>
                                        <th scope="col">Loket</th>
                                        <th scope="col">Nomor Antrian</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-admin-dashboard">
                                        @php
                                            $i = 1;
                                        @endphp
                                        {{-- {{ dd($currentQueues) }} --}}
                                        @foreach ($currentQueues as $queue)
                                            <tr>
                                                <th scope="row">{{ $i++ }}</th>
                                                <td>{{ empty($queue['name']) ? '-' : $queue['name']}}</td>
                                                <td>{{ empty($queue['number']) ? '-' : $queue['number']}}</td>
                                                <td>{{ !$queue['status'] ? '-' : $queue['status'] }}</td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card" style="height: 70vh; width:100%;">
                        <span class="ms-4 mt-3 text-title-sm">Daftar Layanan</span>
                        <hr class="mx-3">
                        <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                            <table class="table table-admin-dashboard text-center mt-3 table-striped table-hover">
                                <thead class="thead-admin-dashboard">
                                    <tr class="table-active" style="color: var(--text-icon-color) !important;">
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Bagian</th>
                                        <th scope="col">Inisial</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-admin-dashboard">
                                    @if (!$services)
                                        <div class="d-flex justify-content-center align-items-center mx-3 mb-3"
                                            style="height: 100%">
                                            <span class="blank">Layanan belum tersedia</span>
                                        </div>
                                    @else
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($services as $service)
                                            <tr>
                                                <th scope="row">{{ $i++ }}</th>
                                                <td>{{ $service['name'] }}</td>
                                                <td>{{ $service['role'] == 'registration' ? 'Pendaftaran' : 'Poli' }}
                                                </td>
                                                <td>{{ $service['initial'] }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card" style="height: 70vh; width:100%;">
                        <span class="ms-4 mt-3 text-title-sm">Daftar Operator</span>
                        <hr class="mx-3">
                        <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                            <table class="table table-admin-dashboard text-center mt-3 table-striped table-hover">
                                <thead class="thead-admin-dashboard">
                                    <tr class="table-active" style="color: var(--text-icon-color) !important;">
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Bagian</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-admin-dashboard">
                                    @if (!$users)
                                        <div class="d-flex justify-content-center align-items-center mx-3 mb-3"
                                            style="height: 100%">
                                            <span class="blank">Operator Belum Tersedia</span>
                                        </div>
                                    @else
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($users as $user)
                                            <tr>
                                                <th scope="row">{{ $i++ }}</th>
                                                <td>{{ $user['name'] }}</td>
                                                <td>{{ $user['username'] }}</td>
                                                <td>{{ $user['role'] }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card" style="height: 70dvh; width:100%;">
                        <span class="ms-4 mt-3 text-title-sm">Daftar Loket</span>
                        <hr class="mx-3">
                        <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                            <table class="table table-admin-dashboard text-center mt-3 table-striped table-hover">
                                <thead class="thead-admin-dashboard">
                                    <tr class="table-active" style="color: var(--text-icon-color) !important;">
                                        <th scope="col">No</th>
                                        <th scope="col">Loket</th>
                                        <th scope="col">Operator</th>
                                        <th scope="col">Layanan</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-admin-dashboard">
                                    @if (!$counters)
                                        <div class="d-flex justify-content-center align-items-center mx-3 mb-3"
                                            style="height: 100%">
                                            <span class="blank">Loket belum tersedia</span>
                                        </div>
                                    @else
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($counters as $counter)
                                            <tr>
                                                <th scope="row">{{ $i++ }}</th>
                                                <td>{{ $counter['name'] }}</td>
                                                <td>{{ $counter['operator']['name'] }}</td>
                                                <td>{{ $counter['service']['name'] ?? "(kosong)" }}</td>
                                                <td>{{ $counter['is_active'] ? 'Aktif' : 'Tidak Aktif' }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
