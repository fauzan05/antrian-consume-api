<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Attributes\On; 

class ServiceEditForm extends Component
{
    public $id;
    public $name;
    public $initial;
    public $role;
    public $description;

    protected $rules = [
        'name' => 'required|string|min:3|max:100',
        'initial' => 'required|string|min:1',
        'role' => 'required|string|min:1',
        'description' => 'nullable|string' 
    ];

    public $service; // data current service
    public $message;
    public $token;
    public $color;
    public $api_url;
    public $headers;
    
    public function mount($service, $token)
    {
        $this->token = $token;
        $this->headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];
        $this->api_url = config('services.api_url');
        $this->service = $service;
        $this->setCurrentEditForm();
    }

    public function updateService()
    {
        $this->validate();
        $response = Http::withHeaders($this->headers)->put($this->api_url . '/services/' . $this->id, [
            'name' => $this->name,
            'initial' => $this->initial,
            'role' => $this->role,
            'description' => $this->description
        ]);

        if($response->unauthorized())
        {
            $this->color = true;
            $this->message = $response['message'];
            return;
        }
        if($response->conflict())
        {
            $this->color = true;
            $this->message = json_decode($response->body(), JSON_OBJECT_AS_ARRAY)['error']['error_message'];
            return;
        }
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        session()->flash('status', ['page' => 3, 'message' => 'Berhasil mengubah ' . $this->service['name']]);
        $this->redirect('/admin');
    }

    public function delete()
    {
        Http::withHeaders($this->headers)->delete($this->api_url . '/services/' . $this->id);
        session()->flash('status', ['page' => 3, 'message' => 'Berhasil menghapus ' . $this->service['name']]);
        $this->redirect('/admin');
    }

    public function setCurrentEditForm()
    {
        $this->id = $this->service['id'];
        $this->name = $this->service['name'];
        $this->initial = $this->service['initial'];
        $this->role = $this->service['role'];
        $this->description = $this->service['description'];
    }

    #[On('service-updated')]
    public function serviceUpdated($data)
    {
        // merefresh tampilan edit service
        unset($this->message);
        $this->service = $data;
        $this->setCurrentEditForm();
    }

    public function render()
    {
        return view('livewire.service-edit-form');
    }
}
