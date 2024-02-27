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
    </style>
</head>

<body>
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
            <span>Nomor Antrian</span>
        </div>
        <div style="margin-bottom: 10px">
            <span> <strong>{{ $selected_queue['registration_number'] }}</strong></span>
        </div>
        <hr class="line">
        <div>
            <span class="footer">{{ $app_settings['text_footer_display'] }}</span>
        </div>
    </div>

</body>

</html>
