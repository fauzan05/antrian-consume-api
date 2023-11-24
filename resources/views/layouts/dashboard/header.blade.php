    <div class="container-fluid">
        <div class="row">
            <div class="col-2 p-0">
                <div class="d-flex flex-column align-items-center text-bg-dark" style="width: 100%; height: 100vh">
                    <div class="row">
                        <div class="col-3 d-flex flex-row align-items-center m-4">
                            <img src="{{ asset('storage/img/logo-puskesmas.png') }}" class="me-3 mb-2" alt=""
                                style="width: 100%" />
                            <h5>Puskesmas Example</h5>
                        </div>
                        <hr>
                        <div class="d-flex flex-column justify-content-between" style="min-height: 80vh;">
                            <span>
                                <div class="col-12 ms-4">
                                    <a class="nav-link">Menu</a>
                                </div>
                                <div class="col-12 d-flex flex-column mt-3">
                                    <ul class="nav mb-auto nav-pills">
                                        <li class="nav-item ms-2" style="width: 100%">
                                            <a href="#" class="nav-link text-white">
                                                <i class="fa-solid fa-list-ol m-3"></i>Antrian
                                            </a>
                                        </li>
                                        <li class="nav-item ms-2" style="width: 100%">
                                            <a href="#" class="nav-link text-white">
                                                <i class="fa-solid fa-gear m-3"></i>Pengaturan
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </span>
                            <div class="mt-auto">
                                <div class="col-12 mb-4">
                                    <div class="row d-flex align-items-center justify-content-center">
                                        <div class="col-3">
                                            <img src="{{ asset('storage/img/blank-profile.jpg') }}"
                                                class="rounded-circle" alt="" style="width: 100%;">
                                        </div>
                                        <div class="col-6">
                                            <p>{{ $user['data']['name'] . ' - ' . $user['data']['role'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10 p-0 ">
                <nav class="navbar navbar-expand-sm nav-color shadow-sm">
                    <a class="navbar-brand ms-5" href="#">Dashboard</a>
                    <form class="d-flex form-inline my-2 mx-auto" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-outline-success" type="submit">
                            Search
                        </button>
                    </form>
                    <div class="icon">
                        <i class="fa-solid fa-envelope mx-3" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            data-bs-title="Inbox"></i>
                        <i class="fa-solid fa-bell mx-3" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            data-bs-title="Notifikasi"></i>
                        <i class="fa-solid fa-power-off mx-3 me-5" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            data-bs-title="Logout"></i>
                    </div>
                </nav>
