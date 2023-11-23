<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class GetCounter extends Component
{
    public $cookie;
    public $userId;

    public function getCounter()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->cookie
        ])->get('http://127.0.0.1:8000/api/users/'. $this->userId .'/counters');
    }

    public function mount($userId)
    {
        $this->userId = $userId;
    }
    
    public function render()
    {
        return view('livewire.get-counter');
    }
}
