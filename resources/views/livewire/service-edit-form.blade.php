<div class="mb-3 test">
    @if (isset($message))
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="alert {{ $color ? 'alert-danger' : 'alert-success' }} text-center" role="alert"
                style="width: 80%;">
                {{ $message }}
            </div>
        </div>
    @endif
    <form wire:submit="updateService">
        @csrf
        <div class="forms gap-3">
            <div>
                <label for="exampleFormControlInput1" class="form-label">Nama Layanan</label>
                <input wire:model="name" type="text" class="form-control" id="exampleFormControlInput1"
                    value="{{ $name }}">
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label">Pilih Inisial</label>
                <select wire:model="initial" class="form-select" aria-label="Default select example">
                    @for ($i = 1; $i <= 26; $i++)
                        @if ($initial != chr($i + 64))
                            <option value="{{ chr($i + 64) }}">{{ chr($i + 64) }}</option>
                        @else
                            <option value="{{ $initial }}" selected>{{ $initial }}</option>
                        @endif
                    @endfor
                </select>
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label">Pilih Bagian</label>
                <select wire:model="role" class="form-select" aria-label="Default select example">
                    @if ($role == 'registration')
                        <option selected value="registration">Pendaftaran</option>
                        <option value="poly">Poli</option>
                    @elseif($role == 'poly')
                        <option selected value="poly">Poli</option>
                        <option value="registration">Pendaftaran</option>
                    @endif
                </select>
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                <div class="mb-3">
                    <textarea wire:model="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $description }}</textarea>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center gap-3">
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
                    Apakah anda ingin menghapus layanan {{ $name ?? '' }} ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" wire:click="delete()" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
