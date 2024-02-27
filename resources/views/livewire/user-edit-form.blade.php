<div class="mb-3 test">
    @if (isset($message))
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="alert {{ $color ? 'alert-danger' : 'alert-success' }} text-center" role="alert"
                style="width: 80%;">
                {{ $message }}
            </div>
        </div>
    @endif
    <form wire:submit="updateUser">
        @csrf
        <input type="hidden" name="token" data-csrf="{{csrf_token()}}" value="{{ csrf_token() }}">
        <div class="forms gap-3">
            <div>
                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                <input wire:model="name" type="text" class="form-control"
                    value="{{ $name }}">
                @error('name')
                    <span class="error text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label">Username</label>
                <input wire:model="username" type="text" class="form-control"
                    value="{{ $username }}">
                @error('username')
                    <span class="error text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div>
                <label for="exampleInputPassword1" class="form-label">Password Lama</label>
                <input wire:model="old_password" type="password" autocomplete="{{ csrf_token() }}" class="form-control" id="exampleInputPassword1">
                @error('old_password')
                    <span class="error text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div>
                <label for="exampleInputPassword2" class="form-label">Password Baru</label>
                <input wire:model="new_password" type="password" autocomplete="{{ csrf_token() }}" class="form-control" id="exampleInputPassword2">
                @error('new_password')
                    <span class="error text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div>
                <label for="exampleInputPassword1" class="form-label">Konfirmasi Password Baru</label>
                <input wire:model="new_password_confirmation" type="password" autocomplete="{{ csrf_token() }}" class="form-control" id="exampleInputPassword3">
                @error('new_password_confirmation')
                    <span class="error text-danger"> {{ $message }} </span>
                @enderror
            </div>
        </div>
        <div class="form-check form-switch d-flex flex-column justify-content-center align-items-center gap-3 mb-4">
            <div class="d-flex flex-row gap-3">
                <input class="form-check-input" wire:click="switchs()" type="checkbox" role="switch"
                    id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Hanya Mengganti Nama/Username Saja</label>
            </div>
            <div>
                <span class="text-sub">{{ $switch ? '( Masukkan Password Lama Untuk Verifikasi)' : '' }}</span>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center gap-3">
            <button type="submit" class="btn btn-primary" style="width: 80%;">Simpan</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete"
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
                    Apakah anda ingin menghapus operator {{ $name ?? '' }} ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" wire:click="delete()" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
