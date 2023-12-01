<div class="container" style="height: 100vh;">
    <div class="p-0 d-flex justify-content-center align-items-center">
        <div class="row m-5 d-flex justify-content-center align-items-center">
            @foreach ($services as $service)
                <a wire:click.prevent="createQueue({{ $service['id'] }})" href="#" class="col-4 m-3"
                    style="width: 40%; height: 30vh;">
                    <div class="card shadow-click text-center" style="height: 100%;">
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
