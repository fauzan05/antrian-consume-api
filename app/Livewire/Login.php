<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;
    public $message;
    public $api_url;
    protected $rules = [
        'username' => 'required|min:3',
        'password' => 'required|min:3',
    ];

    public function mount() {
        $this->api_url = config('services.api_url');
    }
    public function login()
    {
        $this->validate();
        $response = Http::post($this->api_url . '/users/login', [
            'username' => $this->username,
            'password' => $this->password,
        ]);
        if ($response->unauthorized()) {
            $response->body();
            $this->message = $response['error']['error_message'];
            $this->reset('username','password');
            return;
        }
        if ($response->unprocessableEntity()) {
            return redirect('unprocess');
        }
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $role = $response['data']['role'];
        if ($role == 'operator') {
            Cookie::queue('token', $response['token'], 1440);
            if(!Cookie::get('dark-mode')){
                Cookie::queue('dark-mode', (boolean)false);
            }
            return redirect('operator')->with('token', $response['token']);
        } else {
            Cookie::queue('token', $response['token'], 1440);
            if(!Cookie::get('dark-mode')){
                Cookie::queue('dark-mode', (boolean)false);
            }
            return redirect('admin')->with('token', $response['token'] );
        }
    }
    public function render()
    {
        return view('livewire.login');
    }
}
