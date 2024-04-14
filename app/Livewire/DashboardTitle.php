<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DashboardTitle extends Component
{
    public $user_id;
    public $role;
    public $currentCounter;
    public $api_url;

    public function mount($user)
    {
        $this->api_url = config('services.api_url');
        $this->user_id = $user['id'];
        $this->role = $user['role'];
        $this->getCounter();
    }

    public function getCounter()
    {
        $response = Http::get($this->api_url . '/counters/users/' . $this->user_id);
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->currentCounter = $response['data']['name'];
        $this->dispatch('current-counter-id', data: $response['data']['id']);
    }
   
    public function render()
    {
        return view('livewire.dashboard-title');
    }
}
