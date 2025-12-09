@php
$api_url = config('services.api_url')
@endphp
<style>
    .modern-footer {
        background: linear-gradient(135deg, #52c234 0%, #38a169 100%);
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
        padding: 20px 0;
        margin-top: 30px;
        position: relative;
        overflow: hidden;
    }
    
    .modern-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.05)" d="M0,160L48,144C96,128,192,96,288,90.7C384,85,480,107,576,122.7C672,139,768,149,864,138.7C960,128,1056,96,1152,90.7C1248,85,1344,107,1392,117.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
        background-size: cover;
        opacity: 0.5;
    }
    
    .footer-content {
        position: relative;
        z-index: 1;
        overflow: hidden;
        padding: 8px 0;
    }
    
    .footer-text {
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        margin: 0;
        white-space: nowrap;
        display: inline-block;
        padding-left: 100%;
        animation: marquee 30s linear infinite;
        letter-spacing: 0.5px;
    }
    
    @keyframes marquee {
        0% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(-100%, 0);
        }
    }
    
    .footer-text i {
        margin: 0 10px;
        color: rgba(255, 255, 255, 0.8);
    }
    
    @media (max-width: 768px) {
        .footer-text {
            font-size: 1rem;
        }
    }
</style>

<footer class="modern-footer" id="modernFooter">
    <div class="container-fluid">
        <div class="footer-content">
            <p class="footer-text" id="textFooter">
                <i class="fa-solid fa-circle-info"></i> Loading...
            </p>
        </div>
    </div>
</footer>

@push('js')
    <script src="{{ asset('js/clock.js') }}"></script>
    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="module" src="{{ asset('js/call-queue.js') }}"></script>
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js') }}"></script>
@endpush

<script>
    var api_url = "{{ $api_url }}";
    
    // Fetch API data
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                var response = JSON.parse(this.responseText);
                var data = response.data;
                
                // Set footer color
                if (data.footer_color) {
                    var footerColor = data.footer_color;
                    document.getElementById("modernFooter").style.background = footerColor;
                }
                
                // Set footer text - prioritize text_footer_display
                var footerText = '';
                if (data.text_footer_display) {
                    footerText = data.text_footer_display;
                } else {
                    var address = data.address_of_health_institute || 'Sistem Antrian Kesehatan';
                    var currentYear = new Date().getFullYear();
                    footerText = '<i class="fa-solid fa-copyright"></i> ' + currentYear + ' Sistem Antrian | ' + 
                        '<i class="fa-solid fa-location-dot"></i> ' + address + 
                        ' <i class="fa-solid fa-heart"></i> Layanan Kesehatan Terpadu';
                }
                
                document.getElementById("textFooter").innerHTML = footerText;
                
                // Set text color
                if (data.text_footer_color) {
                    var textFooterColor = data.text_footer_color;
                    document.getElementById("textFooter").style.color = textFooterColor;
                }
            } catch(e) {
                console.error('Error parsing footer data:', e);
            }
        }
    };
    xhttp.open("GET", api_url + "/app", true);
    xhttp.send();
</script>