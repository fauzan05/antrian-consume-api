<div>
    @if (session('status_create_counter'))
        <div class="alert alert-{{ session('status_create_counter')['color'] }} alert-dismissible fade show mb-3" role="alert">
            {{ session('status_create_counter')['message'] }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form wire:submit="createCounter">
        <div class="d-flex flex-column gap-3 mb-3">
            <div>
                <label class="form-label fw-medium text-body" style="font-size: 13px;">Nama Loket</label>
                <select wire:model.live="name" name="name" class="form-select" required style="border-radius: 8px;">
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
                <label class="form-label fw-medium text-body" style="font-size: 13px;">Pilih Layanan</label>
                <select wire:model.live="service_id" name="service_id" class="form-select" required style="border-radius: 8px;">
                    <option value="" selected disabled>Pilih Layanan</option>
                    @foreach ($services as $service)
                        <option value="{{ $service['id'] }}">{{ $service['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label fw-medium text-body" style="font-size: 13px;">Pilih Operator</label>
                <select wire:model.live="user_id" name="user_id" class="form-select" required style="border-radius: 8px;">
                    <option value="" selected disabled>Pilih Operator</option>
                    @foreach ($users as $user)
                        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label fw-medium text-body" style="font-size: 13px;">Status</label>
                <select wire:model.live="is_active" name="is_active" class="form-select" required style="border-radius: 8px;">
                    <option selected value="true">Aktif</option>
                    <option value="false">Tidak Aktif</option>
                </select>
            </div>
        </div>
        <div class="modal-footer border-0 pt-3">
            <button type="button" wire:click="flush()" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
            <button type="submit" class="btn btn-success" style="border-radius: 8px;">Buat Loket</button>
        </div>
    </form>
</div>
