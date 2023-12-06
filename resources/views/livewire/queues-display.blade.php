<div class="container-fluid" style="height: auto;">
    <div class="row d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-6 border border-warning" style="height: 60%">
            <div class="row d-flex flex-column justify-content-center align-items-center border" style="height: 100%">
                <div class="col-12 rounded-top d-flex justify-content-center align-items-center m-1 bg-success"
                    style="height: 20%; width:90%;">
                    <h3 class="text-white">NOMOR ANTRIAN</h3>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center m-1 bg-success"
                    style="height: 45%; width:90%;">
                    <h1 class="text-white"  style="font-size: 80px"> {{ $nextQueue }}</h1>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center rounded-bottom border m-1 bg-success" style="height: 20%; width:90%;">
                    <h3 class="text-white"> {{ $nextService }} </h3>
                </div>
            </div>
        </div>
        <div class="col-6 border border-warning" style="height: 60%">
        </div>
        <div class="col-12 g-0 d-flex border justify-content-center align-items-center border border-danger"
            style="height: 40%">
            <div class="row d-flex border justify-content-around align-items-center" style="height:100%; width:100%;">
                @foreach ($currentQueues as $item)
                    <div class="col-3 mx-2 d-flex flex-column rounded justify-content-center bg-success text-center"
                        style="height: 25vh; width: 30vh;">
                        <h3 class="text-white">{{ $item['name'] }}</h3>
                        <hr>
                        <h1 class="text-white">
                            {{ $item['number'] }}
                        </h1>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
