<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Attributes\On; 

class DashboardTitle extends Component
{
    public $role;
    public $userid;
    public $token;
    public $currentCounter;

    #[On('user-name')]
    public function mount()
    {
        $this->userid;
    }
    
    #[On('user-name')]
    public function getUserId($data)
    {
        $this->userid = $data;
    } 

    public function getCounter()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->get('http://localhost:8000/api/counters/users/' . $this->user_id);
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        // dd($response['data']);
        $this->currentCounter = $response['data']['name'];
    }

    public function render()
    {
        return view('livewire.dashboard-title');
    }
}
