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

    public function mount()
    {
        $this->getAllData();
    }

    public function getAllData()
    {
        $responses = Http::pool(fn (Pool $pool) => [
            $pool->get('http://127.0.0.1:8000/api/queues/counters/current-queue'),
            $pool->get('http://127.0.0.1:8000/api/services'),
            $pool->get('http://127.0.0.1:8000/api/users'),
            $pool->get('http://127.0.0.1:8000/api/counters'),
            $pool->get('http://127.0.0.1:8000/api/queues/count'),
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

        $this->servicesCount = count($responses[1]['data']);
        $this->usersCount = count($responses[2]['data']);
        $this->countersCount = count($responses[3]['data']);
    }

    public function render()
    {
        return view('livewire.admin-dashboard-content');
    }
}
