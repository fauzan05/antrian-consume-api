<div class="mb-3">
    @if (isset($message))
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="alert {{ $color ? 'alert-danger' : 'alert-success' }} text-center" role="alert"
                style="width: 80%;">
                {{ $message }}
            </div>
        </div>
    @endif
    <form wire:submit="createService">
        @csrf
        <div class="d-flex flex-column gap-3 mb-3">
            <div>
                <label for="exampleFormControlInput1" class="form-label">Nama Layanan</label>
                <input wire:model="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nama Layanan">
                @error('name') <span class="error text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label">Pilih Inisial</label>
                <select wire:model="initial" class="form-select" aria-label="Default select example">
                    @for ($i = 1; $i <= 26; $i++)
                            <option value="{{ chr($i + 64) }}">{{ chr($i + 64) }}</option>
                    @endfor
                </select>
                @error('initial') <span class="error text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label">Pilih Bagian</label>
                <select wire:model="role" class="form-select" aria-label="Default select example">
                        <option selected value="registration">Pendaftaran</option>
                        <option value="poly">Poli</option>
                </select>
                @error('role') <span class="error text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                <div class="mb-3">
                    <textarea wire:model="description" name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Deskripsi Layanan">{{ $description }}</textarea>
                    @error('description') <span class="error text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Buat</button>
        </div>
    </form>
</div>
