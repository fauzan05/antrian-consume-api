<div class="container" style="height: 100vh;">
    @if(session('status'))
    <div class="alert alert-danger my-5 text-center" role="alert">
       {{session('status')}}
    </div>
    @endif
    <div class="p-0 d-flex justify-content-center align-items-center">
        <div class="row m-5 d-flex justify-content-center align-items-center" style="width: 100%">
            @foreach ($services as $service)
                <a wire:click.prevent="createQueue({{ $service['id'] }})" class="col-4 m-3"
                    style="width: 40%; height: 30vh; cursor: pointer;">
                    <div class="card shadow-click bg-success text-center align-items-center " style="height: 100%;">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <hr>
                            <h3 class="card-text">{{ $service['name'] }}</h3>
                            <hr>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>