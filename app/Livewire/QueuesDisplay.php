<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On; 

class QueuesDisplay extends Component
{
    public $nextQueue;
    public $nextService;
    public $currentQueues;
    public function mount()
    {
        $this->getCurrentQueue();
    }
    public function getListeners()
    {
        return [
            'echo:queues-menus-channel,QueuesMenusEvent' => 'getQueuesInfo',
            'echo:services-menus-channel,ServicesMenusEvent' => 'getQueuesInfo',
        ];
    }
    public function getQueuesInfo()
    {
        $this->getCurrentQueue();
    }

    #[On('currentQueueUpdated')]
    public function getEventCurrentQueue($data)
    {
        $this->nextQueue = $data[0];
        $this->nextService = $data[1];
    }

    public function getCurrentQueue()
    {
        $response = Http::get('http://localhost:8000/api/counters/current-queue');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->currentQueues = $response['data'];
    }
    public function render()
    {
        return view('livewire.queues-display');
    }
}
