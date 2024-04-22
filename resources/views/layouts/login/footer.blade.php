@php
$api_url = config('services.api_url')
@endphp
<footer>
    <nav id="footer" class="navbar fixed-bottom">
        <div class="container-fluid">
            <span id="textFooter" class="ms-3"></span>
        </div>
    </nav>
</footer>
@push('js')
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js') }}"></script>
@endpush
<script>
    var api_url = "{{ $api_url }}"
    // console.log(api_url)
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText)
            var footerColor = response.data.footer_color
            document.getElementById("footer").style.backgroundColor = footerColor;
            var address = response.data.address_of_health_institute
            document.getElementById("textFooter").innerHTML = "© 2023 Antrian | " + address;
            var textFooterColor = response.data.text_footer_color
            document.getElementById("textFooter").style.color = textFooterColor
            // console.log(this.responseText
       }
    };
    xhttp.open("GET",  api_url + "/app", true);
    xhttp.send();
</script>