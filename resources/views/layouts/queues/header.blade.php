@php
$api_url = config('services.api_url')
@endphp
<header>
    <nav id="navbar" class="navbar shadow navbar-expand-sm d-flex navbar-dark py-3">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img id="logo" src="" alt="Bootstrap" width="40" height="40">
                <span id="nameOfHealthInstitute" class="px-3">Untitled</span>
            </a>
            <div class="border rounded">
                <h3 id="time" class="text-white m-2"></h3>
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
            document.getElementById("nameOfHealthInstitute").innerHTML = nameOfHealthInstitute;
            var logo = response.data.selected_logo
            var logoSrc = '{{ asset("assets/logo") }}/' + logo
            document.getElementById("logo").setAttribute('src', logoSrc)
            var headerColor = response.data.header_color
            document.getElementById("navbar").style.backgroundColor = headerColor
            var textHeaderColor = response.data.text_header_color
            document.getElementById("nameOfHealthInstitute").style.color = textHeaderColor
            // console.log(this.responseText
       }
    };
    xhttp.open("GET",  api_url + "/app", true);
    xhttp.send();
</script>