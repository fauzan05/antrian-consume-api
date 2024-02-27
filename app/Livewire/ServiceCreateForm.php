<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ServiceCreateForm extends Component
{
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

    public $message;
    public $token;
    public $color;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function createService()
    {
        $this->validate();
        // dd($this->name, $this->initial, $this->role, $this->description);
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->post('http://127.0.0.1:8000/api/services', [
            'name' => $this->name,
            'initial' => $this->initial,
            'role' => $this->role,
            'description' => $this->description
        ]);
        // dd($response->body());
        if($response->unauthorized())
        {
            $this->color = true;
            $this->message = $response['message'];
            session()->flash('status_create_counter', ['color' => 'danger', 'message' => $this->message]);
            // $this->setCurrentCreateForm();
            return;
        }
        if($response->conflict())
        {
            $this->color = true;
            $this->message = json_decode($response->body(), JSON_OBJECT_AS_ARRAY)['error']['error_message'];
            session()->flash('status_create_counter', ['color' => 'danger', 'message' => $this->message]);
            // $this->setCurrentCreateForm();
            return;
        }
        // dd($response->body());
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        // dd($response);
        session()->flash('status', ['page' => 3, 'message' => 'Berhasil membuat ' . $this->name]);
        $this->redirect('/admin');
    }

    public function render()
    {
        return view('livewire.service-create-form');
    }
}
