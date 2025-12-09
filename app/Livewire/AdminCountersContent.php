<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Http\Client\Pool;
use Livewire\Attributes\On;

class AdminCountersContent extends Component
{
    public $isEdit = false;
    public $counters;
    public $currentDataEdit; // data services, users, dan current counter yang dipilih
    public $dataCreate;
    public $counterId;
    public $selectedCounterId;
    public $selectedCounterName;
    public $users;
    public $services;
    public $token;
    public $api_url;

    public function mount($token)
    {
        $this->token = $token;
        $this->api_url = config('services.api_url');
        $this->getAllCounters();
        $this->getData();
        $this->createCounter(); // agar create counter didistribusikan terlebih dahulu untuk data services dan users
    }

    public function createCounter()
    {
        $this->dataCreate = [
            'services' => $this->services,
            'users' => $this->users
        ];
    }

    public function flush()
    {
        $this->dispatch('flush'); // karena harus di flush dari dalam komponen si counter-create-form
    }

    public function editCounter($counterId, $counterName, $counterServiceId, $counterOperatorId, $counterIsActive)
    {
        $dataEdit = [
            'counter' => [
                'id' => $counterId,
                'name' => $counterName,
                'service_id' => $counterServiceId,
                'user_id' => $counterOperatorId,
                'is_active' => $counterIsActive,
            ],
            'services' => $this->services,
            'users' => $this->users,
        ];

        $this->isEdit = true;
        $this->currentDataEdit = $dataEdit;
        $this->counterId = $counterId;
    }

    public function getData()
    {
        // mengambil data services dan users terlebih dahulu untuk didistribusikan ke create dan edit
        $responses = Http::pool(fn (Pool $pool) => [$pool->get($this->api_url . '/services'), $pool->get($this->api_url . '/users')]);
        $responses[0] = json_decode($responses[0]->body(), JSON_OBJECT_AS_ARRAY);
        $responses[1] = json_decode($responses[1]->body(), JSON_OBJECT_AS_ARRAY);
        $this->services = $responses[0]['data'] ?? [];
        $this->users = $responses[1]['data'] ?? [];
    }

    public function getAllCounters()
    {
        $response = Http::get($this->api_url . '/counters');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->counters = $response['data'] ?? [];
    }

    public function selectCounter($id, $name)
    {
        $this->selectedCounterId = $id;
        $this->selectedCounterName = $name;
    }

    public function deleteCounter()
    {
        if ($this->selectedCounterId) {
            $response = Http::withToken($this->token)->delete($this->api_url . '/counters/' . $this->selectedCounterId);
            
            if ($response->successful()) {
                session()->flash('status', [
                    'message' => 'Loket berhasil dihapus!'
                ]);
                
                // Close modal with JavaScript
                $this->js("
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModalCounter'));
                    if (modal) modal.hide();
                ");
                
                // Refresh data
                $this->getAllCounters();
                $this->getData();
                $this->createCounter();
            }
            
            $this->selectedCounterId = null;
            $this->selectedCounterName = null;
        }
    }

    #[On('counter-updated')]
    public function refreshCounters()
    {
        $this->getAllCounters();
        $this->getData();
        $this->createCounter();
    }

    public function render()
    {
        return view('livewire.admin-counters-content');
    }
}
