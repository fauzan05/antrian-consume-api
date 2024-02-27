<header>
    <nav class="navbar shadow navbar-expand-sm d-flex navbar-dark bg-success py-3">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ url('/') }}">
                <img src="{{ asset('storage/img/logo-puskesmas.png') }}" alt="Bootstrap" width="40" height="40">
                <span class="px-3">Rumah Sakit Demo</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto px-5">
                    <li class="active nav-link px-4">Home</li>
                    <li class="active nav-link px-4">About</li>
                    <li class="active nav-link pe-5 ps-4">FAQ</li>
                </ul>
            </div>
        </div>
    </nav>
</header>