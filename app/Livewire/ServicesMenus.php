<?php

namespace App\Livewire;

use App\Events\ServicesMenusEvent;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ServicesMenus extends Component
{
    public $services;
    
    public function mount()
    {
        $this->getServices();
    }

    public function getServices()
    {
        $response = Http::get('http://localhost:8000/api/services');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->services = $response['data'];
    }
    
    public function createQueue($id)
    {
        Http::post('http://localhost:8000/api/queues', [
            'service_id' => $id
        ]);
        Broadcast(new ServicesMenusEvent());
        $this->getServices();
        $this->render();
    }
    public function render()
    {
        return view('livewire.services-menus');
    }
}
