<div>
    @if (session('status_edit_counter'))
        <div class="alert alert-{{ session('status_edit_counter')['color'] }} alert-dismissible fade show mb-3" role="alert">
            {{ session('status_edit_counter')['message'] }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form wire:submit="updateCounter">
        <div class="d-flex flex-column gap-3 mb-3">
            <div>
                <label class="form-label fw-medium text-body" style="font-size: 13px;">Nama Loket</label>
                <select wire:model.live="name" name="name" class="form-select" required style="border-radius: 8px;">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($counter['name'] != 'Loket ' . $i)
                            <option value="Loket {{ $i }}">Loket {{ $i }}</option>
                            @if ($i == 10)
                                @for ($i = 1; $i <= 10; $i++)
                                    @if ($counter['name'] != 'Loket ' . chr(64 + $i))
                                        <option value="Loket {{ chr(64 + $i) }}">Loket {{ chr(64 + $i) }}</option>
                                    @else
                                        <option value="Loket {{ chr(64 + $i) }}">Loket {{ chr(64 + $i) }}</option>
                                    @endif
                                @endfor
                            @endif
                        @else
                            <option value="{{ $counter['name'] }}" selected>{{ $counter['name'] }}</option>
                        @endif
                    @endfor
                </select>
            </div>
            <div>
                <label class="form-label fw-medium text-body" style="font-size: 13px;">Pilih Layanan</label>
                <select wire:model.live="service_id" name="service_id" class="form-select" style="border-radius: 8px;">
                    @if (empty($service_id))
                        <option value="" disabled selected>Pilih Layanan</option>
                    @endif
                    @foreach ($services as $key => $service)
                        @if ($service_id != $service['id'])
                            <option value="{{ $service['id'] }}">{{ $service['name'] }}</option>
                        @elseif($service['id'] == $service_id)
                            <option value="{{ $service['id'] }}" selected>{{ $service['name'] }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label fw-medium text-body" style="font-size: 13px;">Pilih Operator</label>
                <select wire:model.live="user_id" name="user_id" class="form-select" style="border-radius: 8px;">
                    @foreach ($users as $user)
                        @if ($user_id != $user['id'])
                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                        @else
                            <option value="{{ $user_id }}">{{ $user['name'] }}</option selected>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label fw-medium text-body" style="font-size: 13px;">Status</label>
                <select wire:model.live="is_active" name="is_active" class="form-select" style="border-radius: 8px;">
                    <option value="1" @if ($is_active == true) selected @endif>Aktif</option>
                    <option value="0" @if ($is_active == false) selected @endif>Tidak Aktif</option>
                </select>
            </div>
        </div>
        <div class="modal-footer border-0 pt-3">
            <button type="button" wire:click="flush()" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
            <button type="submit" class="btn btn-primary" style="border-radius: 8px;">Simpan Perubahan</button>
        </div>
    </form>
</div>
