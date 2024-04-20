<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ServiceCreateForm extends Component
{
    public $name;
    public $initial = "A";
    public $role = "registration";
    public $description;

    protected $rules = [
        'name' => 'required|string|min:3|max:100',
        'initial' => 'required|string|min:1',
        'role' => 'required|string|min:1',
        'description' => 'nullable|string' 
    ];

    public $message;
    public $token;
    public $color;
    public $api_url;
    public $headers;

    public function mount($token)
    {
        $this->token = $token;
        $this->headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];
        $this->api_url = config('services.api_url');
    }

    public function createService()
    {
        $this->validate();
        $response = Http::withHeaders($this->headers)->post($this->api_url . '/services', [
            'name' => $this->name,
            'initial' => $this->initial,
            'role' => $this->role,
            'description' => $this->description
        ]);
        if($response->unauthorized())
        {
            $this->color = true;
            $this->message = $response['message'];
            session()->flash('status_create_counter', ['color' => 'danger', 'message' => $this->message]);
            return;
        }
        if($response->conflict())
        {
            $this->color = true;
            $this->message = json_decode($response->body(), JSON_OBJECT_AS_ARRAY)['error']['error_message'];
            session()->flash('status_create_counter', ['color' => 'danger', 'message' => $this->message]);
            return;
        }
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        session()->flash('status', ['page' => 3, 'message' => 'Berhasil membuat ' . $this->name]);
        $this->redirect('/admin');
    }

    public function render()
    {
        return view('livewire.service-create-form');
    }
}
