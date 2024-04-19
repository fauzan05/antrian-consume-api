<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;

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
    public $api_url;
    public $headers;

    public function mount($dataCreate, $token)
    {
        $this->token = $token;
        $this->api_url = config('services.api_url');
        $this->headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];
        $this->services = $dataCreate['services'];
        $this->users = $dataCreate['users'];
        $this->setCurrentCreateForm();
    }
    
    public function createCounter()
    {             
        $this->validate();
        $response = Http::withHeaders($this->headers)->post($this->api_url . '/counters', [
            'name' => $this->name,
            'user_id' => $this->user_id,
            'service_id' => $this->service_id,
            'is_active' => $this->is_active
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
