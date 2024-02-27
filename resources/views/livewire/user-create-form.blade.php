<div class="mb-3">
    @if (isset($message))
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="alert {{ $color ? 'alert-danger' : 'alert-success' }} text-center" role="alert"
                style="width: 80%;">
                {{ $message }}
            </div>
        </div>
    @endif
    <form wire:submit="createUser">
        @csrf
        <input type="hidden" name="token" data-csrf="{{csrf_token()}}" value="{{ csrf_token() }}">
        <div class="d-flex flex-column gap-3 mb-3">
            <div>
                <label class="form-label">Nama</label>
                <input wire:model="name" type="text" class="form-control">
                @error('name') <span class="error text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div>
                <label class="form-label">Username</label>
                <input wire:model="username" type="text" class="form-control">
                @error('username') <span class="error text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div>
                <label class="form-label">Password</label>
                <input wire:model="password" type="password" autocomplete="{{ csrf_token() }}" class="form-control">
                @error('password') <span class="error text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div>
                <label class="form-label">Konfirmasi Password</label>
                <input wire:model="password_confirmation" type="password" autocomplete="{{ csrf_token() }}" class="form-control">
                @error('password_confirmation') <span class="error text-danger"> {{ $message }} </span>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Buat</button>
        </div>
    </form>
</div>
