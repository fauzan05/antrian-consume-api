<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class GetCurrentUser extends Component
{
    public $token;
    public $name;
    public $role;

    public function mount($token)
    {
        $this->token = $token;
        $this->getUser();
    }

    public function getUser()
    {
        $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token
            ])->get('http://127.0.0.1:8000/api/users/current');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        // dd(var_dump($response));
        $this->name = $response['data']['name'];
        $this->role = $response['data']['role'];
    }

    public function render()
    {
        return view('livewire.get-current-user');
    }
}
