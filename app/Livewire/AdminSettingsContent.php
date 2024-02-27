<?php

namespace App\Livewire;

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AdminSettingsContent extends Component
{
    use WithFileUploads;

    public $selected_video;

    #[Validate('nullable|mimes:mp4,mov,mkv,mpeg|max:50000|min:1000')]
    public $video;
    public $name;
    public $address;
    public $jam_buka = [];
    public $jam_tutup = [];
    public $is_active = [];
    public $viewOpen = [];
    public $viewClose = [];
    public $footerText;
    public $footerColor = "#49c36e";
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

    public function mount($token)
    {
        $this->token = $token;
        $this->getSelectedVideo();
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
        $this->getSelectedVideo();
    }

    public function isCloseVideo()
    {
        if($this->is_delete_video){
            $this->is_delete_video = (bool)$this->is_delete_video ? (bool)false : (bool)true;
            $this->getSelectedVideo();
        }
    }
    public function isDeleteSchedules()
    {
        $this->is_delete_schedules = (bool)$this->is_delete_schedules ? (bool)false : (bool)true;
        $this->deleteAllSchedule();
        $this->getSelectedVideo();
    }

    public function isCloseSchedules()
    {
        if($this->is_delete_schedules){
            $this->is_delete_schedules = (bool)$this->is_delete_schedules ? (bool)false : (bool)true;
            $this->getSelectedVideo();
        }
    }

    public function deleteVideo()
    {
        if(empty($this->selected_video)){
            return session()->flash('status_delete_video', ['color' => 'danger','message' => 'Tidak ada video yang terhapus']);
        }
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->delete('http://127.0.0.1:8000/api/files/videos/' . trim($this->selected_video));
        // dd($response->body());
        session()->flash('status_delete_video', ['color' => 'success', 'message' => 'Berhasil menghapus video']);
    }

    public function updateSettings()
    {
        $this->validate();
        // dd($this->video, $this->name, $this->address, $this->footerText, $this->footerColor);
        if (!empty($this->video)) {
            $path = $this->video->getRealPath();
            $originalName = $this->video->getClientOriginalName();
            Http::delete('http://127.0.0.1:8000/api/files/videos');
            Http::attach(
                'video_file',
                file_get_contents($path),
                $originalName
            )->post('http://127.0.0.1:8000/api/admin/settings/videos');
        }
        if (!empty(trim($this->name)) || !empty(trim($this->address))) {
            Validator::make(
                ['name' => $this->name, 'address' => $this->address],
                ['name' => 'required|min:3|max:50|string', 'address' => 'required|min:3|max:100|string'],
                ['required' => 'Kolom :attribute harus diisi', 'min' => 'Kolom :atttribute minimal :min karakter', 'max' => 'Kolom :attribute maksimal :max karakter']
            )->validate();
            Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token
            ])->put('http://127.0.0.1:8000/api/admin/settings/identity', [
                'name_of_health_institute' => trim($this->name),
                'address_of_health_institute' => trim($this->address)
            ]);
        }
        if (!empty(trim($this->footerText))) {
            Validator::make(
                ['footerText' => $this->footerText],
                ['footerText' => 'required|min:3|max:100|string'],
                ['required' => 'Kolom :attribute harus diisi', 'min' => 'Kolom :atttribute minimal :min karakter', 'max' => 'Kolom :attribute maksimal :max karakter']
            )->validate();
            Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token
            ])->put('http://127.0.0.1:8000/api/admin/settings/text-footer', [
                'text_footer_display' => trim($this->footerText)
            ]);
        }

        if (!empty(trim($this->footerColor))) {
            Validator::make(
                ['footerColor' => $this->footerColor],
                ['footerColor' => 'required|max:10|string'],
                ['required' => 'Kolom :attribute harus diisi', 'max' => 'Kolom :atttribute maksimal :max karakter']
            )->validate();
            Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token
            ])->put('http://127.0.0.1:8000/api/admin/settings/color-footer', [
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
        // // dd($this->is_active);
        foreach ($this->jam_buka as $key => $item) :
            unset($this->jam_buka[$key]);
        endforeach;
        foreach ($this->jam_tutup as $key => $item) :
            unset($this->jam_tutup[$key]);
        endforeach;
        // foreach($this->is_active as $key => $item):
        //     unset($this->is_active[$key]);
        // endforeach;
        // dd($this->jam_buka, $this->jam_tutup);
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
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->put('http://127.0.0.1:8000/api/admin/settings/operational-hours', [
            'data' => $this->schedule
        ]);
        // $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        // dd($response);
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
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->put('http://127.0.0.1:8000/api/users/update', [
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
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->delete('http://127.0.0.1:8000/api/admin/settings/operational-hours');
        session()->flash('status_delete_schedules', ['color' => 'success', 'message' => 'Berhasil menghapus jadwal operasional']);
        $this->showOperationalHours();
    }

    public function getSelectedVideo()
    {
        $response = Http::get('http://127.0.0.1:8000/api/admin/settings/selected-video');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->selected_video = $response['data'] ?? null;
    }

    public function getSelectedIdentity()
    {
        $response = Http::get('http://127.0.0.1:8000/api/admin/settings');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->name = $response['data']['name_of_health_institute'] ?? null;
        $this->address = $response['data']['address_of_health_institute'] ?? null;
        $this->footerText = $response['data']['text_footer_display'] ?? null;
        $this->footerColor = $response['data']['display_footer_color'] ?? $this->footerColor;
    }

    public function showOperationalHours()
    {
        $response = Http::get('http://127.0.0.1:8000/api/admin/settings/operational-hours');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->operationalHours = $response['data'] ?? null;
    }

    public function render()
    {
        return view('livewire.admin-settings-content');
    }
}
