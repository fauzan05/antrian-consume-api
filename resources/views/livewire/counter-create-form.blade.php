<div class="mb-3">
    @if (session('status_create_counter'))
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="alert alert-{{ session('status_create_counter')['color'] }} text-center" role="alert"
                style="width: 80%;">
                {{ session('status_create_counter')['message'] }}
            </div>
        </div>
    @endif
    <form wire:submit="createCounter">
        {{-- @csrf --}}
        <div class="d-flex flex-column gap-3 mb-3">
            <div>
                <label for="exampleFormControlInput1" class="form-label">Nama Loket</label>
                <select wire:model.live="name" name="name" class="form-select" required>
                    <option value="" selected disabled>Pilih Loket</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="Loket {{ $i }}">Loket {{ $i }}</option>
                        @if ($i == 10)
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="Loket {{ chr(64 + $i) }}">Loket {{ chr(64 + $i) }}</option>
                            @endfor
                        @endif
                    @endfor
                </select>
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label">Pilih Layanan</label>
                <select wire:model.live="service_id" name="service_id" class="form-select"
                    aria-label="Default select example" required>
                    <option value="" selected disabled>Pilih Layanan</option>
                    @foreach ($services as $service)
                        <option value="{{ $service['id'] }}">{{ $service['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label">Pilih Operator</label>
                <select wire:model.live="user_id" name="user_id" class="form-select" aria-label="Default select example"
                    required>
                    <option value="" selected disabled>Pilih Operator</option>
                    @foreach ($users as $user)
                        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="exampleFormControlInput1" class="form-label">Status</label>
                <select wire:model.live="is_active" name="is_active" class="form-select" aria-label="Default select example"
                    required>
                    <option selected value="true">Aktif</option>
                    <option value="false">Tidak Aktif</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" wire:click="flush()" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Buat</button>
        </div>
    </form>
</div>
