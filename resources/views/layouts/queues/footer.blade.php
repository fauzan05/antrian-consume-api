@php
$api_url = config('services.api_url')
@endphp
<footer style="padding-top: 30px">
    <nav id="footer" class="navbar mt-2">
        <div class="container-fluid">
            <span id="textFooter" class="ms-3"></span>
        </div>
    </nav>
</footer>
@push('js')
    <script src="{{ asset('js/clock.js') }}"></script>
    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="module" src="{{ asset('js/call-queue.js') }}"></script>
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