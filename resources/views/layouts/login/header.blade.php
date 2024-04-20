@php
$api_url = config('services.api_url')
@endphp
<header>
    <nav class="navbar shadow navbar-expand-sm d-flex navbar-dark bg-success py-3">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ url('/') }}">
                <img id="logo" src="" alt="Bootstrap" width="40" height="40">
                <span id="nameOfHealthInstitute" class="px-3">Untitled</span>
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
            var logoSrc = '{{ asset("assets/logo") }}/' + logo
            document.getElementById("logo").setAttribute('src', logoSrc)
            // console.log(this.responseText
       }
    };
    xhttp.open("GET",  api_url + "/app", true);
    xhttp.send();
</script>