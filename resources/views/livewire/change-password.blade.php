<div class="d-flex justify-content-between align-items-center mt-5 mb-5" style="height: 80%;">
    <div class="row m-2 d-flex justify-content-center align-items-center">
        <div class="col-10">
            <div class="card info-antrian shadow-sm text-center" style="width: 100%;">
                <div class="card-body rounded d-flex justify-content-center align-items-center">
                    <div class="col-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-10 py-4">
                                    <h3>Silahkan Masukkan Password Lama dan Password Baru Anda</h3>
                                </div>
                            </div>
                            <div class="col-10">
                                <img src="{{ asset('storage/img/login.jpg') }}" alt="" style="width: 100%;">
                            </div>
                        </div>
                    </div>
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
                                    <input type="password" name="old_password" class="form-control"
                                        wire:model.live="old_password" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('old_password')
                                        <span class="error text-danger">{{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Password
                                        Baru</label>
                                    <input type="password" class="form-control" wire:model.live="new_password"
                                        id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('new_password')
                                        <span class="error text-danger">{{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Verifikasi
                                        Password Baru</label>
                                    <input type="password" class="form-control" wire:model.live="new_password_confirmation"
                                        id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('new_password_confirmation')
                                        <span class="error text-danger">{{ $message }} </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mt-4 col-12">Ubah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
