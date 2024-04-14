<?php

namespace App\Livewire;

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Attributes\On; 

class AdminDashboardContent extends Component
{
    public $currentQueues;
    public $services;
    public $users;
    public $counters;
    public $countersCount;
    public $queuesCount;
    public $usersCount;
    public $servicesCount;
    public $api_url;

    public function mount()
    {
        $this->api_url = config('services.api_url');
        $this->getAllData();
    }

    public function getAllData()
    {
        $responses = Http::pool(fn (Pool $pool) => [
            $pool->get($this->api_url . '/queues/counters/current-queue'),
            $pool->get($this->api_url . '/services'),
            $pool->get($this->api_url . '/users'),
            $pool->get($this->api_url . '/counters'),
            $pool->get($this->api_url . '/queues/count'),
        ]);
        $responses[0] = json_decode($responses[0]->body(), JSON_OBJECT_AS_ARRAY);
        $responses[1] = json_decode($responses[1]->body(), JSON_OBJECT_AS_ARRAY);
        $responses[2] = json_decode($responses[2]->body(), JSON_OBJECT_AS_ARRAY);
        $responses[3] = json_decode($responses[3]->body(), JSON_OBJECT_AS_ARRAY);
        $responses[4] = json_decode($responses[4]->body(), JSON_OBJECT_AS_ARRAY);
        $this->currentQueues = $responses[0]['data'] ?? [];
        $this->services = $responses[1]['data'] ?? 0;
        $this->users = $responses[2]['data'] ?? 0;
        $this->counters = $responses[3]['data'] ?? 0;
        $this->queuesCount = $responses[4]['data'] ?? 0;
        $this->servicesCount = count($responses[1]['data']) ?? 0;
        $this->usersCount = count($responses[2]['data']) ?? 0;
        $this->countersCount = count($responses[3]['data']) ?? 0;
    }

    public function render()
    {
        return view('livewire.admin-dashboard-content');
    }
}
