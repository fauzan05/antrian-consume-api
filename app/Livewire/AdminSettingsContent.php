<?php

namespace App\Livewire;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminSettingsContent extends Component
{
    use WithFileUploads;

    public $selected_video;
    public $selected_logo;

    #[Validate('nullable|mimes:mp4,mov,mkv,mpeg|max:50000|min:1000')]
    public $video;

    #[Validate('nullable|image|max:5000|min:50')]
    public $logo;
    public $name;
    public $address;
    public $jam_buka = [];
    public $jam_tutup = [];
    public $is_active = [];
    public $viewOpen = [];
    public $viewClose = [];
    public $footerText;
    public $footerColor = "#49c36e";
    public $footerTextColor = "#ffff";
    public $headerColor = "#49c36e";
    public $headerTextColor = "#ffff";
    public $operationalHours;
    public $token;
    public $schedule;
    public $password_lama;
    public $password_baru;
    public $konfirmasi_password_baru;
    public $message;
    public $color;
    public $is_delete_video = false;
    public $is_delete_schedules = false;
    public $api_url;
    public $headers;

    public function mount($token)
    {
        $this->token = $token;
        $this->api_url = config('services.api_url');
        $this->headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];
        $this->showOperationalHours();
        $this->setFirstStateOperationalHours();
        $this->getSelectedIdentity();
    }

    public function setFirstStateOperationalHours()
    {
        foreach ($this->operationalHours as $item) :
            $this->viewOpen[] = $item['open'];
            $this->viewClose[] = $item['close'];
            $this->jam_buka[$item['id']] =  $item['open'];
            $this->jam_tutup[$item['id']] = $item['close'];
            $this->is_active[$item['id']] = (bool)$item['is_active'];
        endforeach;
    }

    public function isDeleteVideo()
    {
        $this->is_delete_video = (bool)$this->is_delete_video ? (bool)false : (bool)true;
        $this->deleteVideo();
    }

    public function isCloseVideo()
    {
        if($this->is_delete_video){
            $this->is_delete_video = (bool)$this->is_delete_video ? (bool)false : (bool)true;
        }
    }
    public function isDeleteSchedules()
    {
        $this->is_delete_schedules = (bool)$this->is_delete_schedules ? (bool)false : (bool)true;
        $this->deleteAllSchedule();
    }

    public function isCloseSchedules()
    {
        if($this->is_delete_schedules){
            $this->is_delete_schedules = (bool)$this->is_delete_schedules ? (bool)false : (bool)true;
        }
    }

    public function deleteVideo()
    {
        if(empty($this->selected_video)){
            return session()->flash('status_delete_video', ['color' => 'danger','message' => 'Tidak ada video yang terhapus']);
        }
        File::delete(public_path('/assets/video/') . $this->selected_video);
        Http::withHeaders($this->headers)->delete($this->api_url . '/app/video/' . trim($this->selected_video));
        $this->reset('selected_video');
        session()->flash('status_delete_video', ['color' => 'success', 'message' => 'Berhasil menghapus video']);
    }

    public function updateSettings()
    {
        if (!empty($this->video)) {
            // hapus dulu file video sebelumnya
            File::delete(public_path('/assets/video/') . $this->selected_video);

            $getRealPath = $this->video->getRealPath();
            $hashName = $this->video->hashName();
            File::move($getRealPath, public_path('/assets/video/') . $hashName);
            Http::withHeaders($this->headers)->post($this->api_url . '/app/video', [
                'video_filename' => $hashName
            ]);
        }

        if (!empty($this->logo)) {
            // hapus dulu file logo sebelumnya
            File::delete(public_path('/assets/logo') . $this->selected_logo);

            $getRealPath = $this->logo->getRealPath();
            $hashName = $this->logo->hashName();
            File::move($getRealPath, public_path('/assets/logo/') . $hashName);
            Http::withHeaders($this->headers)->post($this->api_url . '/app/logo', [
                'logo_filename' => $hashName
            ]);
        }

        if (!empty(trim($this->name)) || !empty(trim($this->address))) {
            $validator = Validator::make(
                ['name' => $this->name, 'address' => $this->address],
                ['name' => 'required|min:3|max:50|string', 'address' => 'required|min:3|max:100|string'],
                ['required' => 'Kolom :attribute harus diisi', 'min' => 'Kolom :atttribute minimal :min karakter', 'max' => 'Kolom :attribute maksimal :max karakter']
            )->validate();
            Http::withHeaders($this->headers)->put($this->api_url . '/app/identity', [
                'name_of_health_institute' => trim($validator['name']),
                'address_of_health_institute' => trim($validator['address'])
            ]);
        }

        if (!empty(trim($this->footerText))) {
            Validator::make(
                ['footerText' => $this->footerText],
                ['footerText' => 'required|min:3|max:100|string'],
                ['required' => 'Kolom :attribute harus diisi', 'min' => 'Kolom :atttribute minimal :min karakter', 'max' => 'Kolom :attribute maksimal :max karakter']
            )->validate();
            Http::withHeaders($this->headers)->put($this->api_url . '/app/text-footer', [
                'text_footer_display' => trim($this->footerText)
            ]);
        }

        if (!empty(trim($this->footerColor)) && !empty(trim($this->footerColor))) {
            Validator::make(
                ['footerColor' => $this->footerColor],
                ['footerColor' => 'required|max:10|string'],
                ['required' => 'Kolom :attribute harus diisi', 'max' => 'Kolom :atttribute maksimal :max karakter']
            )->validate();
            Http::withHeaders($this->headers)->put($this->api_url . '/app/color-footer', [
                'display_footer_color' => trim($this->footerColor)
            ]);
        }

        session()->flash('status', ['page' => 5, 'message' => 'Berhasil menyimpan pengaturan']);
        $this->redirect('/admin');
    }

    public function isActive($id)
    {
        if (empty($this->is_active[$id])) {
            $this->is_active[$id] = true;
        } else {
            $this->is_active[$id] = $this->is_active[$id] ? false : true;
        }
    }

    public function resetSchedule()
    {
        foreach ($this->jam_buka as $key => $item) :
            unset($this->jam_buka[$key]);
        endforeach;
        foreach ($this->jam_tutup as $key => $item) :
            unset($this->jam_tutup[$key]);
        endforeach;
    
        $this->showOperationalHours();
        foreach ($this->operationalHours as $item) :
            $this->viewOpen[] = $item['open'];
            $this->viewClose[] = $item['close'];
            $this->jam_buka[$item['id']] =  $item['open'];
            $this->jam_tutup[$item['id']] = $item['close'];
        endforeach;
    }

    public function updateOperationalHours()
    {
        foreach ($this->jam_buka as $id => $openValue) {
            $this->schedule[$id] = [$openValue, $this->jam_tutup[$id], $this->is_active[$id]];
        }
        Http::withHeaders($this->headers)->put($this->api_url . '/app/operational-hours', [
            'data' => $this->schedule
        ]);

        session()->flash('status', ['page' => 5, 'message' => 'Berhasil mengubah jadwal operasional']);
        $this->redirect('/admin', );
    }

    public function updateAdminPassword()
    {
        Validator::make(
            ['password_lama' => $this->password_lama, 'password_baru' => $this->password_baru, 'konfirmasi_password_baru' => $this->konfirmasi_password_baru],
            ['password_lama' => 'required|min:3|max:50|string', 'password_baru' => 'required|min:3|max:50|string', 'konfirmasi_password_baru' => 'required|min:3|max:50|same:password_baru'],
            ['required' => 'Kolom :attribute harus diisi', 'same' => 'Password baru tidak sama']
        )->validate();
        $response = Http::withHeaders($this->headers)->put($this->api_url . '/users/update-password', [
            'old_password' => $this->password_lama,
            'new_password' => $this->password_baru,
            'new_password_confirmation' => $this->konfirmasi_password_baru
        ]);
        if ($response->unauthorized()) {
            if (!isset($response['message'])) {
                $this->color = true;
                $this->message = json_decode($response->body(), JSON_OBJECT_AS_ARRAY)['error']['error_message'];
                $this->reset('password_lama', 'password_baru', 'konfirmasi_password_baru');
                return;
            } else {
                $this->color = true;
                $this->message = $response['message'];
                $this->reset('password_lama', 'password_baru', 'konfirmasi_password_baru');
                return;
            }
        }
        session()->flash('status', ['page' => 5, 'message' => 'Berhasil mengubah password admin']);
        $this->redirect('/admin', );
    }

    public function deleteAllSchedule()
    {
        Http::withHeaders($this->headers)->delete($this->api_url . '/app/operational-hours');
        session()->flash('status_delete_schedules', ['color' => 'success', 'message' => 'Berhasil menghapus jadwal operasional']);
        $this->showOperationalHours();
    }

    public function getSelectedIdentity()
    {
        $response = Http::get($this->api_url . '/app');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->name = $response['data']['name_of_health_institute'] ?? null;
        $this->address = $response['data']['address_of_health_institute'] ?? null;
        $this->footerText = $response['data']['text_footer_display'] ?? null;
        $this->footerColor = $response['data']['display_footer_color'] ?? $this->footerColor;
        $this->selected_video = $response['data']['selected_video'] ?? null;
        $this->selected_logo = $response['data']['selected_logo'] ?? null;
    }

    public function showOperationalHours()
    {
        $response = Http::get($this->api_url . '/app/operational-hours');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->operationalHours = $response['data'] ?? null;
    }

    public function render()
    {
        return view('livewire.admin-settings-content');
    }
}
