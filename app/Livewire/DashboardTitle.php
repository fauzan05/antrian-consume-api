<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Attributes\On; 

class DashboardTitle extends Component
{
    public $user;
    public $role;
    public $token;
    public $currentCounter;

    public function mount($token)
    {
        $this->token = $token;
        $this->getUser();
        $this->getCounter();
    }
    
    public function getUser()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->get('http://localhost:8000/api/users/current');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->user = $response['data'];
        $this->role = $response['data']['role'];
        $this->dispatch('users', data: $this->user);
    }

    public function getCounter()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->get('http://localhost:8000/api/counters/users/' . $this->user['id']);
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->currentCounter = $response['data']['name'];
    }

    public function render()
    {
        return view('livewire.dashboard-title');
    }
}
