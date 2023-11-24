<div class="col-12">
    <table class="table align-middle table-responsive table-hover shadow-sm">
        <thead>
            <tr class="table-active">
                <th scope="col">No</th>
                <th scope="col">Nomor Antrian</th>
                <th scope="col">Jenis Layanan</th>
                <th scope="col">Status</th>
                <th scope="col">Panggil</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($data as $item)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $item['number'] }}</td>
                    <td>{{ $item['service_name'] }}</td>
                    <td>{{ $item['status'] }}</td>
                    <td><a href="#" class="ms-4" style="color: red">
                            <i class="fa-solid fa-microphone"></i> </a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
