<div class="container-fluid" style="height: auto;">
    <div class="row d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-6" style="height: 60%">
            <div class="row d-flex flex-column justify-content-center align-items-center" style="height: 100%">
                <div class="col-12 rounded-top d-flex justify-content-center align-items-center m-1 bg-success"
                    style="height: 20%; width:90%;">
                    <h3 class="text-white">NOMOR ANTRIAN</h3>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center m-1 bg-success"
                    style="height: 45%; width:90%;">
                    <h1 class="text-white"  style="font-size: 80px"> {{ $nextQueue }}</h1>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center rounded-bottom m-1 bg-success" style="height: 20%; width:90%;">
                    <h3 class="text-white"> {{ $nextService }} </h3>
                </div>
            </div>
        </div>
        <div class="col-6 d-flex justify-content-center align-items-center" style="height: 60%">
            <video width="100%" height="90%" loop autoplay muted>
                <source src="{{asset('assets/video/' . $selected_video)}}">
            </video>
        </div>
        <div class="col-12 g-0 d-flex justify-content-center align-items-center" style="height: 40%">
            <div class="row d-flex justify-content-around align-items-center" style="height:100%; width:100%; overflow: auto;">
                @foreach ($currentQueues as $item)
                    <div class="m-2 d-flex flex-column rounded justify-content-center bg-success text-center" style="height: 100%; width: calc(100% / 5);">
                        <h4 class="text-white">{{ $item['name'] }}</h4>
                        <hr>
                        <h1 class="text-white">
                            {{ $item['number'] }}
                        </h1>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="col-12 mt-2 bg-success">
            <marquee style="color: white !important">
                {{$text_footer_display}}
            </marquee>
        </div>
    </div>
</div>
