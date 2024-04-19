<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ChangePassword extends Component
{
    public $token;
    public $old_password;
    public $new_password;
    public $new_password_confirmation;
    public $message;
    public $api_url;
    public $headers;
    protected $rules = [
        'old_password' => 'required|min:3',
        'new_password' => 'required|min:3',
        'new_password_confirmation' => 'required|min:3|same:new_password',
    ];
    public function mount($token)
    {
        $this->token = $token;
        $this->headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ];
        $this->api_url = config('services.api_url');
    }
    public function update()
    {
        $this->validate();
        $response = Http::withHeaders($this->headers)->put($this->api_url . '/users/update-password', [
            'old_password' => $this->old_password,
            'new_password' => $this->new_password,
            'new_password_confirmation' => $this->new_password_confirmation,
        ]);
        if ($response->unauthorized()) {
            $this->message = 'Password Lama Salah!';
            $this->reset('old_password', 'new_password', 'new_password_confirmation');
            return $this->render();
        }
        $this->reset(); // menghapus semua value properties
        return redirect('operator/pengaturan')->with('message', 'Ubah Password Berhasil!');
    }
    public function render()
    {
        return view('livewire.change-password', [
            'token' => $this->token,
        ]);
    }
}
