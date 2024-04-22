@php
    $api_url = config('services.api_url');
@endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-2 p-0">
            <div class="d-flex flex-column align-items-center text-bg-dark" style="width: 100%; height: 100vh">
                <div class="row">
                    <div class="col-3 d-flex flex-row align-items-center m-4">
                        <img id="logo" src="" class="me-3 mb-2" alt="" style="width: 100%" />
                        <h5 id="nameOfHealthInstitute">Untitled</h5>
                    </div>
                    <div class="d-flex flex-column justify-content-between" style="min-height: 80vh;">
                        <hr>
                        <span>
                            <div class="col-12 ms-4">
                                <a class="nav-link">Menu</a>
                            </div>
                            <div class="col-12 d-flex flex-column mt-3">
                                <ul class="nav mb-auto nav-pills">
                                    <li class="nav-item ms-2" style="width: 100%">
                                        <a href="{{ url('operator') }}" class="nav-link text-white sidebar-button">
                                            <i class="fa-solid fa-list-ol m-3"></i>Antrian
                                        </a>
                                    </li>
                                    <li class="nav-item ms-2" style="width: 100%">
                                        <a href="{{ url('operator/pengaturan') }}"
                                            class="nav-link text-white sidebar-button">
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
                                        <img src="{{ asset('storage/img/blank-profile.jpg') }}" class="rounded-circle"
                                            alt="" style="width: 100%;">
                                    </div>
                                    <div class="col-6">
                                        <p>{{ $user['name'] . ' - ' . $user['role'] }}</p>
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
                @livewire('dashboard-title', ['user' => $user])
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
                    <a href="{{ url('logout') }}" style="color: red">
                        <i class="fa-solid fa-power-off mx-3 me-5" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            data-bs-title="Logout"></i>
                    </a>
                </div>
            </nav>
            <script>
                var api_url = "{{ $api_url }}"
                // console.log(api_url)
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var response = JSON.parse(this.responseText)
                        var nameOfHealthInstitute = response.data.name_of_health_institute
                        var color = response.data.display_footer_color
                        document.getElementById("nameOfHealthInstitute").innerHTML = nameOfHealthInstitute;
                        var logo = response.data.selected_logo
                        var logoSrc = '{{ asset('assets/logo') }}/' + logo
                        document.getElementById("logo").setAttribute('src', logoSrc)
                        var headerColor = response.data.header_color
                        // console.log(this.responseText
                    }
                };
                xhttp.open("GET", api_url + "/app", true);
                xhttp.send();
            </script>
