<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Http\Request;

class Login extends Component
{
    public $username;
    public $password;
    public $message;
    protected $rules = [
        'username' => 'required|min:3',
        'password' => 'required|min:3',
    ];
    public function login()
    {
        $this->validate();
        $response = Http::post('http://localhost:8000/api/users/login', [
            'username' => $this->username,
            'password' => $this->password,
        ]);
        if ($response->unauthorized()) {
            $response->body();
            // dd($response['error']['error_message']);
            $this->message = $response['error']['error_message'];
            $this->reset('username','password');
            return $this->render();
        }
        if ($response->unprocessableEntity()) {
            return redirect('unprocess');
        }
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $role = $response['data']['role'];
        if ($role == 'operator') {
            Cookie::queue('token', $response['token'], 1440);
            return redirect('operator')->with('token', $response['token']);
        } else {
            Cookie::queue('token', $response['token'], 1440);
            return redirect('admin');
        }
    }
    public function render()
    {
        return view('livewire.login');
    }
}
