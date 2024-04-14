<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AdminServicesContent extends Component
{
    public $isEdit = false;
    public $serviceId;
    public $token;
    public $services;
    public $currentService; // layanan yang dipilih
    public $api_url;

    public function mount($token)
    {
        $this->token = $token;
        $this->api_url = config('services.api_url');
        $this->getAllServices();
    }

    public function editService($serviceId, $serviceName, $serviceRole, $serviceInitial, $serviceDescription)
    {
        $service = [
            'id' => $serviceId,
            'name' => $serviceName,
            'role' => $serviceRole,
            'initial' => $serviceInitial,
            'description' => $serviceDescription
        ];

        if($this->serviceId != $serviceId)
        {
            $this->isEdit = true;
            $this->serviceId = $serviceId;
            $this->currentService = $service;
            $this->dispatch('service-updated', data: $service); // memperbaharui service ketika di klik lagi
        }else if($this->serviceId == $serviceId){
            $this->isEdit = $this->isEdit ? false : true;
            $this->serviceId = $serviceId;
            $this->currentService = $service;
        }
    }

    public function getAllServices()
    {
        $response = Http::get($this->api_url . '/services');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->services = $response['data'];
    }

    public function render()
    {
        return view('livewire.admin-services-content');
    }
}
