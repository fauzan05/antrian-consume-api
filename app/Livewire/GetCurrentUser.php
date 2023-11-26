<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class GetCurrentUser extends Component
{
    public $token;
    public $id;
    public $name;
    public $data;
    public $username;
    public $role;

    public function mount($token)
    {
        $this->token = $token;
        $this->getUser();
        // $this->dispatchToken();
        // // $this->dispatchId();
        // $this->dispatchName();
        // $this->dispatchUsername();
        // $this->dispatchRole();
    }

    public function getUser()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->get('http://127.0.0.1:8000/api/users/current');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->id = $response['data']['id'];
        $this->name = $response['data']['name'];
        $this->role = $response['data']['role'];
        $this->data = $response['data'];
        $this->dispatch('user-name', data:$this->name);
    }

    // public function dispatchId()
    // {
    //     $this->dispatch('user_id', ['id' => $this->id]);
    // }
    // public function dispatchName()
    // {
    //     $this->dispatch('user_name', name:$this->name);
    // }
    // public function dispatchUsername()
    // {
    //     $this->dispatch('user_username', username:$this->username);
    // }
    // public function dispatchRole()
    // {
    //     $this->dispatch('user_role', role:$this->role);
    // }
    // public function dispatchToken()
    // {
    //     $this->dispatch('user_token', token:$this->token);
    // }
    public function render()
    {
        return view('livewire.get-current-user');
    }
}
