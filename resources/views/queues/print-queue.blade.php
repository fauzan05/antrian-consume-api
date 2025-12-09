<!DOCTYPE html>

<head>
    <title>Tiket Antrian</title>
    <style>
        .container {
            border: 1px solid black;
            display: flex;
            text-align: center;
            flex-direction: column;
            align-content: center;
            justify-content: center;
            width: 100%;
            height: 100dvh;
        }

        .address {
            font-size: 0.5rem
        }

        .title {
            font-size: 0.8rem;
        }

        .line {
            border-top: 1px solid black;
            width: 90%;
        }
        .footer{
            font-size: 0.5rem
        }
        
        .download-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #52c234;
            color: white;
            padding: 15px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            font-size: 1rem;
            z-index: 1000;
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                top: -50px;
                opacity: 0;
            }
            to {
                top: 20px;
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="download-message">
        ✓ Tiket antrian Anda sedang diunduh...
    </div>
    
    <div class="container">
        <div>
            <span><strong>{{ $app_settings['name_of_health_institute'] }}</strong>
            </span>
        </div>
        <div>
            <span class="address">{{ $app_settings['address_of_health_institute'] }}</span>
        </div>
        <hr class="line">
        <div style="margin-bottom: 10px">
            <span>Nomor Antrian Pendaftaran</span>
        </div>
        <div style="margin-bottom: 10px">
            <span> <strong>{{ $selected_queue['registration_number'] }}</strong></span>
        </div>
        <div style="margin-bottom: 10px">
            <span>Nomor Antrian Poli</span>
        </div>
        <div style="margin-bottom: 10px">
            <span> <strong>{{ $selected_queue['poly_number'] }}</strong></span>
        </div>
        <hr class="line">
        <div>
            <span class="footer">{{ $app_settings['text_footer_display'] }}</span>
        </div>
    </div>
    
    <script>
        // Auto trigger download saat halaman dimuat
        window.onload = function() {
            // Redirect ke halaman services setelah 2 detik
            setTimeout(function() {
                window.location.href = "{{ url('/services') }}";
            }, 2000);
        };
    </script>

</body>

</html>
