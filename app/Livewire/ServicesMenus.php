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
        $response = array_filter($response['data'], function($var){
            return $var['role'] == 'poly';
        });
        $this->services = $response;
    }
    
    public function createQueue($id)
    {
        $response = Http::post('http://localhost:8000/api/queues', [
            'poly_service_id' => $id
        ]);
        if($response->forbidden()) {
            $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
            session()->now('status', $response['error']['error_message']);
            return;
        }
        Broadcast(new ServicesMenusEvent());
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->redirect('/print-queue/' . $response['data']['id']);
    }
    public function render()
    {
        return view('livewire.services-menus');
    }
}
