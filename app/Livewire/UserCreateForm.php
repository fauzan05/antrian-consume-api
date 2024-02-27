<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class UserCreateForm extends Component
{
    public $name;
    public $username;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|min:3|max:50',
        'username' => 'required|string|min:3|max:50',
        'password' => 'required|string|min:3|max:50',
        'password_confirmation' => 'required|string|same:password|min:3|max:50'
    ];

    public $message;
    public $token;
    public $color;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function createUser()
    {
        $this->validate();
        // dd($this->name, $this->username, $this->password, $this->password_confirmation);
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->post('http://127.0.0.1:8000/api/users/register', [
            'name' => $this->name,
            'username' => $this->username,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation
        ]);
        if ($response->unauthorized()) {
            if (!isset($response['message'])) {
                $this->color = true;
                $this->message = json_decode($response->body(), JSON_OBJECT_AS_ARRAY)['error']['error_message'];
                $this->reset('password', 'password_confirmation');
                return;
            } else {
                $this->color = true;
                $this->message = $response['message'];
                $this->reset('password', 'password_confirmation');
                return;
            }
        }
        if ($response->conflict()) {
            $this->color = true;
            $this->message = json_decode($response->body(), JSON_OBJECT_AS_ARRAY)['error']['error_message'];
            $this->reset('password', 'password_confirmation');
            return;
        }
        // dd($response->body());
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        session()->flash('status', ['page' => 4, 'message' => 'Berhasil membuat ' . $this->name]);
        $this->redirect('/admin');
    }

    public function render()
    {
        return view('livewire.user-create-form');
    }
}
