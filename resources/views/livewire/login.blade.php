<div class="form-section">
    @if ($message)
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @endif
    <form wire:submit="login">
        @csrf
        <div class="mb-4">
            <label for="username" class="form-label">Username</label>
            <input type="text" wire:model="username" class="form-control" id="username" placeholder="Masukkan username">
            @error('username') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" wire:model="password" class="form-control" id="password" placeholder="Masukkan password">
            @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-login">Masuk</button>
    </form>
    <div class="back-link">
        <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Utama</a>
    </div>
</div>