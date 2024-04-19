<div class="col-12 content">
    <input type="hidden" name="token" data-csrf="{{ csrf_token() }}" value="{{ csrf_token() }}">
    <div class="container-fluid container-content">
        <div class="row no-gutters gap-3">
            <div class="col-12">
                <div class="sub-title m-2">
                    <div class="d-flex flex-column">
                        <span class="text-title">Menu Pengaturan</span>
                        <span class="text-sub-title">Menampilkan beberapa konfigurasi app antrian dan admin</span>
                    </div>
                    @if (session('status'))
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="alert alert-success text-center" role="alert" style="width: 80%;">
                                {{ session('status')['message'] }}
                            </div>
                        </div>
                    @endif
                </div>
                <hr style="color: var(--text-color)">
                <div class="row no-padding">
                    <div class="col-12 mb-3">
                        <div class="card" style="height: auto;">
                            <span class="text-title ms-5 mt-3 mb-3">Konfigurasi Aplikasi</span>
                            <div class="container-fluid ms-5 mb-5 me-5 d-flex flex-column justify-content-center align-items-center border rounded"
                                style="width: 90%; height: 100%;">
                                <form class="m-5" wire:submit="updateSettings">
                                    <div class="input-group mb-3 d-flex flex-column" style="width: 100%">
                                        <div class="d-flex flex-row mb-3">
                                            <label class="form-label text">Unggah Logo</label>
                                            <div class="ms-5 d-flex flex-column">
                                                <input type="file" wire:model.live="logo" class="form-control">
                                                <span class="video-form-text ms-2 mt-2">Format file yang diizinkan: png,
                                                    jpg. File max: 5 Mb, File min: 50 Kb.</span>
                                                <span
                                                    class="video-form-text ms-2">{{ $selected_logo ? 'Logo terkini: ' . $selected_logo : '' }}</span>
                                                @error('logo')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <i id="trash-tooltip" class="trash-icon fa-solid fa-trash-can ms-3 mt-2"
                                                data-bs-toggle="modal" data-bs-target="#exampleModalToggle1" @if(!$selected_logo) hidden @endif></i>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 d-flex flex-column" style="width: 100%">
                                        <div class="d-flex flex-row mb-3">
                                            <label class="form-label text">Unggah Video</label>
                                            <div class="ms-5 d-flex flex-column">
                                                <input type="file" wire:model.live="video" class="form-control">
                                                <span class="video-form-text ms-2 mt-2">Format file yang diizinkan: mp4,
                                                    mov,
                                                    mkv, mpeg. File max: 50 Mb. File min: 1 Mb.</span>
                                                <span
                                                    class="video-form-text ms-2">{{ $selected_video ? 'Video terkini: ' . $selected_video : '' }}</span>
                                                @error('video')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <i id="trash-tooltip" class="trash-icon fa-solid fa-trash-can ms-3 mt-2"
                                                data-bs-toggle="modal" data-bs-target="#exampleModalToggle2" @if(!$selected_video) hidden @endif></i>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 gap-5 d-flex align-items-center" style="width: 100%">
                                        <label for="exampleFormControlInput1" class="form-label text">Nama
                                            Instansi</label>
                                        <input type="text" wire:model.live="name" class="form-control"
                                            id="exampleFormControlInput1" value="{{ $name }}">
                                        @error('name')
                                            <span class="error text-danger" style="font-size: 0.5rem">{{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3 gap-5 d-flex align-items-center" style="width: 100%">
                                        <label for="exampleFormControlInput2" class="form-label text">Alamat
                                            Instansi</label>
                                        <textarea class="form-control" wire:model.live="address" id="exampleFormControlTextarea2" rows="3">{{ $address }}</textarea>
                                        @error('address')
                                            <span class="error text-danger" style="font-size: 0.5rem">{{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3 gap-5 d-flex align-items-center" style="width: 100%">
                                        <label for="exampleFormControlTextarea1" class="form-label text">Teks Footer
                                            Display</label>
                                        <textarea class="form-control" wire:model.live="footerText" id="exampleFormControlTextarea1" rows="3">{{ $footerText }}</textarea>
                                        @error('footerText')
                                            <span class="error text-danger" style="font-size: 0.5rem">{{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3 gap-5 d-flex align-items-center" style="width: 100%">
                                        <label for="exampleColorInput3" class="form-label text">Warna Header</label>
                                        <input type="color" wire:model.live="headerColor"
                                            class="form-control form-control-color" id="exampleColorInput3"
                                            title="Pilih Warna" value="{{ $headerColor }}">
                                        @error('headerColor')
                                            <span class="error text-danger" style="font-size: 0.5rem">{{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3 gap-5 d-flex align-items-center" style="width: 100%">
                                        <label for="exampleColorInput4" class="form-label text">Warna Footer</label>
                                        <input type="color" wire:model.live="footerColor"
                                            class="form-control form-control-color" id="exampleColorInput4"
                                            title="Pilih Warna" value="{{ $footerColor }}">
                                        @error('footerColor')
                                            <span class="error text-danger" style="font-size: 0.5rem">{{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3 gap-5 d-flex align-items-center" style="width: 100%">
                                        <label for="exampleColorInput5" class="form-label text">Warna Teks
                                            Header</label>
                                        <input type="color" wire:model.live="textHeaderColor"
                                            class="form-control form-control-color" id="exampleColorInput5"
                                            title="Pilih Warna" value="{{ $textHeaderColor }}">
                                        @error('textHeaderColor')
                                            <span class="error text-danger" style="font-size: 0.5rem">{{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3 gap-5 d-flex align-items-center" style="width: 100%">
                                        <label for="exampleColorInput6" class="form-label text">Warna Teks
                                            Footer</label>
                                        <input type="color" wire:model.live="textFooterColor"
                                            class="form-control form-control-color" id="exampleColorInput6"
                                            title="Pilih Warna" value="{{ $textFooterColor }}">
                                        @error('textFooterColor')
                                            <span class="error text-danger" style="font-size: 0.5rem">{{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Simpan Pengaturan</button>
                                    <button type="button" wire:click="resetSettings()"
                                        class="btn btn-danger mt-3">Reset Pengaturan</button>
                                </form>
                                <span class="video-form-text ms-2 mt-2 mb-3">* Jika kolom nama instansi diisi, alamat
                                    instansi juga harus diisi. Begitupula sebaliknya.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="card" style="height: auto">
                            <span class="text-title ms-5 mt-3 mb-3">Konfigurasi Jadwal Operasional</span>
                            <div class="container-fluid ms-5 mb-5 me-5 d-flex flex-column justify-content-center align-items-center border rounded"
                                style="width: 80%; height: 100%;">
                                <form class="d-flex flex-column justify-content-center me-3 mt-2"
                                    wire:submit="updateOperationalHours">
                                    @if ($operationalHours)
                                        @foreach ($operationalHours as $key => $item)
                                            <div class="input-group gap-0 no-padding input-group-sm d-flex justify-content-around align-items-center flex-row"
                                                style="width: auto !important;">
                                                <span class="text-day mt-4">{{ $item['days'] }}</span>
                                                <div class="d-flex mx-1 flex-column">
                                                    <span class="text-open">Jam Buka</span>
                                                    <input type="time"
                                                        wire:model.live.blur="jam_buka.{{ $item['id'] }}"
                                                        class="form-control" value="{{ $viewOpen[$key] }}">
                                                    @error('open')
                                                        <span class="error text-danger"
                                                            style="font-size: 0.5rem">{{ $message }} </span>
                                                    @enderror
                                                </div>
                                                <div class="d-flex mx-1 flex-column">
                                                    <span class="text-close">Jam Tutup</span>
                                                    <input type="time"
                                                        wire:model.live.blur="jam_tutup.{{ $item['id'] }}"
                                                        class="form-control" value="{{ $viewClose[$key] }}">
                                                    @error('close')
                                                        <span class="error text-danger"
                                                            style="font-size: 0.5rem">{{ $message }} </span>
                                                    @enderror
                                                </div>
                                                <div class="form-switch form-check-reverse">
                                                    <input id="{{ $item['id'] }}"
                                                        wire:click="isActive({{ $item['id'] }})"
                                                        class="form-check-input check-schedule ms-2 mt-4"
                                                        type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                                        @if ($is_active[$item['id']] || $is_active == 1) checked @endif>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    @endif
                                    <button type="submit" class="btn btn-primary mt-3 mb-3">Simpan</button>
                                    <button type="button" wire:click="resetSchedule()"
                                        class="btn btn-danger mb-3">Reset</button>
                                    <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalToggle2">Hapus Semua</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="card" style="height: auto">
                            <span class="text-title ms-5 mt-3 mb-3">Konfigurasi Password Admin</span>
                            @if (isset($message))
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <div class="alert {{ $color ? 'alert-danger' : 'alert-success' }} text-center"
                                        role="alert" style="width: 80%;">
                                        {{ $message }}
                                    </div>
                                </div>
                            @endif
                            <div class="container-fluid ms-5 mb-5 me-5 d-flex flex-column justify-content-center align-items-center border rounded"
                                style="width: 80%; height: 100%;">
                                <form class="d-flex flex-column justify-content-center me-3 mt-3 mb-3"
                                    wire:submit="updateAdminPassword">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password Lama</label>
                                        <input wire:model="password_lama" type="password"
                                            autocomplete="{{ csrf_token() }}" class="form-control"
                                            id="exampleInputPassword1">
                                        @error('password_lama')
                                            <span class="error text-danger" style="font-size: 0.5rem">{{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword2" class="form-label">Password Baru</label>
                                        <input wire:model="password_baru" type="password"
                                            autocomplete="{{ csrf_token() }}" class="form-control"
                                            id="exampleInputPassword2">
                                        @error('password_baru')
                                            <span class="error text-danger" style="font-size: 0.5rem">{{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword3" class="form-label">Konfirmasi Password
                                            Baru</label>
                                        <input wire:model="konfirmasi_password_baru" type="password"
                                            autocomplete="{{ csrf_token() }}" class="form-control"
                                            id="exampleInputPassword3">
                                        @error('konfirmasi_password_baru')
                                            <span class="error text-danger" style="font-size: 0.5rem">{{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Delete Logo -->
                    <div class="modal fade {{ $is_delete_logo ? 'show' : '' }}" id="exampleModalToggle1"
                        tabindex="-1" aria-labelledby="exampleModalLabel1"
                        @if ($is_delete_logo) aria-modal="true" role="dialog" style="display: block !important;" @else aria-hidden="true" style="display: none" @endif>
                        <div class="modal-dialog settings modal-dialog-centered">
                            <div class="modal-content settings">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if ($is_delete_logo)
                                        @if (session('status_delete_logo'))
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <div class="alert alert-{{ session('status_delete_logo')['color'] }} text-center"
                                                    role="alert" style="width: 80%;">
                                                    {{ session('status_delete_logo')['message'] }}
                                                </div>
                                            </div>
                                        @endif
                                    @elseif($is_delete_logo == false)
                                        <div class="m-2">Anda yakin ingin menghapus logo {{ $selected_logo }}
                                            ?</div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    @if ($is_delete_logo)
                                        <button wire:click="isCloseLogo()" type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Oke</button>
                                    @elseif($is_delete_logo == false)
                                        <button wire:click="isCloseLogo()" type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="button" wire:click="isDeleteLogo()"
                                            class="btn btn-danger">Hapus</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Delete Video -->
                    <div class="modal fade {{ $is_delete_video ? 'show' : '' }}" id="exampleModalToggle2"
                        tabindex="-1" aria-labelledby="exampleModalLabel2"
                        @if ($is_delete_video) aria-modal="true" role="dialog" style="display: block !important;" @else aria-hidden="true" style="display: none" @endif>
                        <div class="modal-dialog settings modal-dialog-centered">
                            <div class="modal-content settings">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if ($is_delete_video)
                                        @if (session('status_delete_video'))
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <div class="alert alert-{{ session('status_delete_video')['color'] }} text-center"
                                                    role="alert" style="width: 80%;">
                                                    {{ session('status_delete_video')['message'] }}
                                                </div>
                                            </div>
                                        @endif
                                    @elseif($is_delete_video == false)
                                        <div class="m-2">Anda yakin ingin menghapus video {{ $selected_video }}
                                            ?</div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    @if ($is_delete_video)
                                        <button wire:click="isCloseVideo()" type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Oke</button>
                                    @elseif($is_delete_video == false)
                                        <button wire:click="isCloseVideo()" type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="button" wire:click="isDeleteVideo()"
                                            class="btn btn-danger">Hapus</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Delete Schedules -->
                    <div class="modal fade {{ $is_delete_schedules ? 'show' : '' }}" id="exampleModalToggle2"
                        tabindex="-1" aria-labelledby="exampleModalLabel2"
                        @if ($is_delete_schedules) aria-modal="true" role="dialog" style="display: block !important;" @else aria-hidden="true" style="display: none" @endif>
                        <div class="modal-dialog settings modal-dialog-centered">
                            <div class="modal-content settings">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if ($is_delete_schedules)
                                        @if (session('status_delete_schedules'))
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <div class="alert alert-{{ session('status_delete_schedules')['color'] }} text-center"
                                                    role="alert" style="width: 80%;">
                                                    {{ session('status_delete_schedules')['message'] }}
                                                </div>
                                            </div>
                                        @endif
                                    @elseif($is_delete_schedules == false)
                                        <div class="m-2">Anda yakin ingin menghapus semua jadwal operasional ?</div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    @if ($is_delete_schedules)
                                        <button wire:click="isCloseSchedules()" type="button"
                                            class="btn btn-secondary" data-bs-dismiss="modal">Oke</button>
                                    @elseif($is_delete_schedules == false)
                                        <button wire:click="isCloseSchedules()" type="button"
                                            class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="button" wire:click="isDeleteSchedules()"
                                            class="btn btn-danger">Hapus</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
