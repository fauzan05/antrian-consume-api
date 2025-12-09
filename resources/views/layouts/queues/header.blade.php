@php
$api_url = config('services.api_url')
@endphp
<style>
    .modern-header {
        background: linear-gradient(135deg, #52c234 0%, #38a169 100%);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        padding: 20px 0;
        position: relative;
        overflow: hidden;
    }
    
    .modern-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.05)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>');
        background-size: cover;
        opacity: 0.5;
    }
    
    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        z-index: 1;
    }
    
    .brand-section {
        display: flex;
        align-items: center;
        gap: 20px;
        text-decoration: none;
        transition: transform 0.3s ease;
    }
    
    .brand-section:hover {
        transform: translateX(5px);
    }
    
    .logo-container {
        width: 70px;
        height: 70px;
        background: white;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    
    .logo-container:hover {
        transform: rotate(5deg) scale(1.05);
    }
    
    .logo-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 8px;
    }
    
    .institute-name {
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        margin: 0;
        letter-spacing: 0.5px;
        transition: color 0.3s ease;
    }
    
    .time-section {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 15px 30px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        min-width: 150px;
        text-align: center;
    }
    
    .time-display {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        margin: 0;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        font-family: 'Arial', 'Courier New', monospace;
        letter-spacing: 3px;
        transition: color 0.3s ease;
    }
    
    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: 15px;
        }
        
        .institute-name {
            font-size: 1.3rem;
        }
        
        .time-display {
            font-size: 1.4rem;
        }
        
        .logo-container {
            width: 50px;
            height: 50px;
        }
    }
</style>

<header class="modern-header" id="modernHeader">
    <div class="container">
        <div class="header-content">
            <a href="{{ url('/') }}" class="brand-section">
                <div class="logo-container">
                    <img id="logo" src="" alt="Logo" style="display: none;">
                </div>
                <h1 class="institute-name" id="nameOfHealthInstitute">Sistem Antrian</h1>
            </a>
            <div class="time-section">
                <p class="time-display" id="time">--:--:--</p>
            </div>
        </div>
    </div>
</header>

<script>
    var api_url = "{{ $api_url }}";
    
    // Fetch API data
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                var response = JSON.parse(this.responseText);
                var data = response.data;
                
                // Set institute name
                var nameOfHealthInstitute = data.name_of_health_institute || 'Sistem Antrian';
                document.getElementById("nameOfHealthInstitute").innerHTML = nameOfHealthInstitute;
                
                // Set logo
                if (data.selected_logo) {
                    var logo = data.selected_logo;
                    var logoSrc = '{{ asset("assets/logo") }}/' + logo;
                    var logoElement = document.getElementById("logo");
                    logoElement.setAttribute('src', logoSrc);
                    logoElement.style.display = 'block';
                }
                
                // Set header color
                if (data.header_color) {
                    var headerColor = data.header_color;
                    document.getElementById("modernHeader").style.background = headerColor;
                }
                
                // Set text color
                if (data.text_header_color) {
                    var textHeaderColor = data.text_header_color;
                    document.getElementById("nameOfHealthInstitute").style.color = textHeaderColor;
                    document.getElementById("time").style.color = textHeaderColor;
                }
            } catch(e) {
                console.error('Error parsing header data:', e);
            }
        }
    };
    xhttp.open("GET", api_url + "/app", true);
    xhttp.send();
</script>