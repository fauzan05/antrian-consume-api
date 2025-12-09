<div class="d-flex justify-content-center align-items-center mt-5 mb-5" style="min-height: 70vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border">
                    <div class="card-body p-5">
                        <div class="row align-items-center">
                            <div class="col-md-5 text-center mb-4 mb-md-0">
                                <h3 class="mb-4 text-body">Ubah Password</h3>
                                <p class="text-body-secondary mb-4">Silahkan masukkan password lama dan password baru Anda</p>
                                <img src="{{ asset('storage/img/login.jpg') }}" alt="Change Password" class="img-fluid rounded" style="max-width: 80%;">
                            </div>
                            <div class="col-md-7">
                                @if (session()->has('message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fas fa-check-circle me-2"></i>
                                        {{ session()->get('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif
                                @if (isset($message))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        {{ $message }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif
                                
                                <form wire:submit="update">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="old_password" class="form-label text-body">Password Lama</label>
                                        <input type="password" 
                                               name="old_password" 
                                               class="form-control @error('old_password') is-invalid @enderror"
                                               wire:model.live="old_password" 
                                               id="old_password">
                                        @error('old_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label text-body">Password Baru</label>
                                        <input type="password" 
                                               class="form-control @error('new_password') is-invalid @enderror" 
                                               wire:model.live="new_password"
                                               id="new_password">
                                        @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="new_password_confirmation" class="form-label text-body">Verifikasi Password Baru</label>
                                        <input type="password" 
                                               class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                                               wire:model.live="new_password_confirmation"
                                               id="new_password_confirmation">
                                        @error('new_password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary w-100 py-2">
                                        <i class="fas fa-save me-2"></i>Ubah Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
