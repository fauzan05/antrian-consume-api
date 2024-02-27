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
    
    public function mount($service, $token)
    {
        $this->service = $service;
        $this->token = $token;
        $this->setCurrentEditForm();
    }

    public function updateService()
    {
        // dd($this->name, $this->initial, $this->role, $this->description);
        $this->validate();
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->put('http://127.0.0.1:8000/api/services/' . $this->id, [
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
        // dd($response->body());
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        session()->flash('status', ['page' => 3, 'message' => 'Berhasil mengubah ' . $this->service['name']]);
        $this->redirect('/admin');
    }

    public function delete()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->delete('http://127.0.0.1:8000/api/services/' . $this->id);
        // dd($response->body());
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
