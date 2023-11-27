<div class="col-4 m-5">
    <div class="col-12">
        @if (session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif
        @if (isset($message))
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @endif
        <form wire:submit="update">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Password
                    Lama</label>
                <input type="password" name="old_password" class="form-control" wire:model="old_password"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('old_password')
                    <span class="error text-danger">{{ $message }} </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Password
                    Baru</label>
                <input type="password" class="form-control" wire:model="new_password" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                @error('new_password')
                    <span class="error text-danger">{{ $message }} </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Verifikasi
                    Password Baru</label>
                <input type="password" class="form-control" wire:model="new_password_confirmation"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('new_password_confirmation')
                    <span class="error text-danger">{{ $message }} </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-4 col-12">Ubah</button>
        </form>
    </div>
</div>
