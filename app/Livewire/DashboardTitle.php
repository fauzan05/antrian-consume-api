<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DashboardTitle extends Component
{
    public $role;
    public $idUser;
    public $token;
    public $currentCounter;
    public function mount($data, $token)
    {
        $this->role = $data['role'];
        $this->idUser = $data['id'];
        $this->token = $token;
        $this->getCounter();
    }
    public function getCounter()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->get('http://localhost:8000/api/counters/users/' . $this->idUser);
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        // dd($response['data']);
        $this->currentCounter = $response['data']['name'];
    }
    public function render()
    {
        return view('livewire.dashboard-title');
    }
}
