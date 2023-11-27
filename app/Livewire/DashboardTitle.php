<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Attributes\On; 

class DashboardTitle extends Component
{
    public $user_id;
    public $role;
    public $currentCounter;

    public function mount($user)
    {
        $this->user_id = $user['id'];
        $this->role = $user['role'];
        $this->getCounter();
    }

    public function getCounter()
    {
        $response = Http::get('http://localhost:8000/api/counters/users/' . $this->user_id);
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->currentCounter = $response['data']['name'];
    }
   
    public function render()
    {
        return view('livewire.dashboard-title');
    }
}
