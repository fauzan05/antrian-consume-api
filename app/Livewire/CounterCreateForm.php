<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;

class CounterCreateForm extends Component
{
    // form
    public $name;
    public $user_id;
    public $service_id;
    public $is_active;

    protected $rules = [
        'name' => 'required|string|min:3|max:100',
        'user_id' => 'required|integer',
        'service_id' => 'required|integer',
        'is_active' => 'nullable|boolean'
    ];

    public $token;
    public $message;
    public $color;
    public $counter;
    public $users;
    public $services;

    public function mount($dataCreate, $token)
    {
        $this->services = $dataCreate['services'];
        $this->users = $dataCreate['users'];
        $this->token = $token;
        $this->setCurrentCreateForm();
    }
    
    public function createCounter()
    {             
        $this->validate();
        // dd($this->name, $this->user_id, $this->service_id, $this->is_active);   
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->post('http://127.0.0.1:8000/api/counters', [
            'name' => $this->name,
            'user_id' => $this->user_id,
            'service_id' => $this->service_id,
            'is_active' => $this->is_active
        ]);

        // dd($response->body());
        if($response->unauthorized())
        {
            $this->color = true;
            $this->message = $response['message'];
            // $this->reset('name', 'user_id', 'service_id', 'is_active');
            session()->flash('status_create_counter', ['color' => 'danger', 'message' => $this->message]);
            // $this->setCurrentCreateForm();
            return;
        }
        if($response->conflict())
        {
            $this->color = true;
            $this->message = json_decode($response->body(), JSON_OBJECT_AS_ARRAY)['error']['error_message'];
            // $this->reset('name', 'user_id', 'service_id', 'is_active');
            session()->flash('status_create_counter', ['color' => 'danger', 'message' => $this->message]);
            // $this->setCurrentCreateForm();
            return;
        }
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        // dd($response);
        session()->flash('status', ['page' => 2, 'message' => 'Berhasil membuat ' . $this->name]);
        $this->redirect('/admin');
    }
    #[On('flush')]
    public function flush()
    {
        session()->forget('status_create_counter');
    }

    public function setCurrentCreateForm()
    {
        // set agar form pertama kali ada nilainya, tidak null
        $this->name = !isset($this->name) ? 'Loket 1' : $this->name;
        $this->user_id = empty($this->users[0]['id']) ? null : $this->users[0]['id'];
        $this->service_id = !empty($this->services) ? $this->services[0]['id'] : null;
        $this->is_active = true;
    }

    public function render()
    {
        return view('livewire.counter-create-form');
    }
}
