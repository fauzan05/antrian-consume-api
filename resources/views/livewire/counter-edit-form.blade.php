<div class="mb-3 test">
    @if (session('status_edit_counter'))
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="alert alert-{{ session('status_edit_counter')['color'] }} text-center" role="alert"
                style="width: 80%;">
                {{ session('status_edit_counter')['message'] }}
            </div>
        </div>
    @endif
    <form wire:submit="updateCounter">
        <div class="forms gap-3">
            <div>
                <label for="exampleFormControlInput1" class="form-label">Nama Loket</label>
                <select wire:model.live="name" name="name" class="form-select" required>
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($counter['name'] != 'Loket ' . $i)
                            <option value="Loket {{ $i }}">Loket {{ $i }}</option>
                            @if ($i == 10)
                                @for ($i = 1; $i <= 10; $i++)
                                    @if ($counter['name'] != 'Loket ' . chr(64 + $i))
                                        <option value="Loket {{ chr(64 + $i) }}">Loket {{ chr(64 + $i) }}</option>
                                    @else
                                        <option value="Loket {{ chr(64 + $i) }}">Loket {{ chr(64 + $i) }}</option>
                                    @endif
                                @endfor
                            @endif
                        @else
                            <option value="{{ $counter['name'] }}" selected>{{ $counter['name'] }}</option>
                        @endif
                    @endfor
                </select>
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label">Pilih Layanan</label>
                <select wire:model.live="service_id" name="service_id" class="form-select"
                    aria-label="Default select example">
                    @if (empty($service_id))
                        <option value="" disabled selected>Pilih Layanan</option>
                    @endif
                    @foreach ($services as $key => $service)
                        @if ($service_id != $service['id'])
                            <option value="{{ $service['id'] }}">{{ $service['name'] }}</option>
                        @elseif($service['id'] == $service_id)
                            <option value="{{ $service['id'] }}" selected>{{ $service['name'] }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label">Pilih Operator</label>
                <select wire:model.live="user_id" name="user_id" class="form-select" aria-label="Default select example">
                    @foreach ($users as $user)
                        @if ($user_id != $user['id'])
                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                        @else
                            <option value="{{ $user_id }}">{{ $user['name'] }}</option selected>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label">Status</label>
                <select wire:model.live="is_active" name="is_active" class="form-select" aria-label="Default select example">
                    <option value="1" @if ($is_active == true) selected @endif>Aktif</option>
                    <option value="0" @if ($is_active == false) selected @endif>Tidak Aktif</option>
                </select>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center gap-3 mt-3">
            <button type="submit" class="btn btn-primary" style="width: 80%;">Simpan</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-danger"
                style="width: 80%;">Hapus</button>
        </div>
    </form>
    <!-- Modal Delete-->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda ingin menghapus loket {{ $name ?? '' }} ?
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="flush()" class="btn btn-secondary"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="button" wire:click="delete()" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
