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
    public $api_url;
    public $headers;

    public function mount($token)
    {
        $this->token = $token;
        $this->headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];
        $this->api_url = config('services.api_url');
    }

    public function createUser()
    {
        $this->validate();
        $response = Http::withHeaders($this->headers)->post($this->api_url . '/users/register', [
            'name' => $this->name,
            'role' => 'operator',
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
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        session()->flash('status', ['page' => 4, 'message' => 'Berhasil membuat ' . $this->name]);
        $this->redirect('/admin');
    }

    public function render()
    {
        return view('livewire.user-create-form');
    }
}
