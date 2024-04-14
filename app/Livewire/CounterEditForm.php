<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;

class CounterEditForm extends Component
{
    // form
    public $id;
    public $name;
    public $user_id;
    public $service_id;
    public $is_active;

    protected $rules = [
        'name' => 'required|string|min:3|max:100',
        'user_id' => 'required|integer',
        'service_id' => 'required|integer',
        'id_active' => 'nullable|boolean'
    ];

    public $token;
    public $message;
    public $color;
    public $counter;
    public $users;
    public $services;
    public $api_url;

    public function mount($currentDataEdit, $token)
    {
        $this->token = $token;
        $this->api_url = config('services.api_url');
        $this->counter = $currentDataEdit['counter'];
        $this->services = $currentDataEdit['services'];
        $this->users = $currentDataEdit['users'];
        $this->setCurrentEditForm();
    }

    public function updateCounter()
    {     
        $this->is_active = (boolean)$this->is_active ? true : false;
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->put($this->api_url . '/counters/' . $this->id, [
            'name' => $this->name,
            'user_id' => $this->user_id,
            'service_id' => $this->service_id,
            'is_active' => (boolean)$this->is_active
        ]);

        if($response->unauthorized())
        {
            $this->color = true;
            $this->message = $response['message'];
            session()->flash('status_edit_counter', ['color' => 'danger', 'message' => $this->message]);
            return;
        }
        if($response->conflict())
        {
            $this->color = true;
            $this->message = json_decode($response->body(), JSON_OBJECT_AS_ARRAY)['error']['error_message'];
            return session()->flash('status_edit_counter', ['color' => 'danger', 'message' => json_decode($response->body(), JSON_OBJECT_AS_ARRAY)['error']['error_message']]);
        }
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        session()->flash('status', ['page' => 2, 'message' => 'Berhasil mengubah ' . $this->counter['name']]);
        $this->redirect('/admin');
    }
    public function flush()
    {
        session()->forget('status_edit_counter');
    }

    public function delete()
    {   
        Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->delete($this->api_url . '/counters/' . $this->id);
        session()->flash('status', ['page' => 2, 'message' => 'Berhasil menghapus ' . $this->counter['name']]);
        $this->redirect('/admin');
    }

    #[On('counter-updated')]
    public function counterDataEdit($data)
    {
        // merefresh tampilan edit counter
        unset($this->message);
        $this->counter = $data['counter'];
        $this->services = $data['services'];
        $this->users = $data['users'];
        $this->reset('name', 'user_id', 'service_id', 'is_active');
        $this->setCurrentEditForm();
    }

    public function setCurrentEditForm()
    {
        $this->id = $this->counter['id'];
        $this->name = $this->counter['name'];
        $this->user_id = $this->counter['user_id'];
        $this->service_id = $this->counter['service_id'];
        $this->is_active = $this->counter['is_active'];
    }

    public function render()
    {
        return view('livewire.counter-edit-form');
    }
}
