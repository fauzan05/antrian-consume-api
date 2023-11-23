<div class="row d-flex flex-row justify-content-center align-items-center">
@foreach($data as $item)
<div class="col-2 m-3">
    <a href="#">
        <div class="card shadow-click text-center" style="width: 100%;">
            <div class="card-body">
                <h3 class="card-text">{{ $item['name'] }}</h3>
                <hr>
                <h4>{{ $item['number'] }}</h4>
            </div>
        </div>
    </a>
</div>
@endforeach
</div>


