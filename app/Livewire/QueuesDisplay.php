<?php

namespace App\Livewire;

use App\Events\ButtonStateEvent;
use Illuminate\Support\Facades\Broadcast;
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
    #[On('buttonState')]
    public function buttonState($counter_id)
    {
        // dd($currentQueue[0]);
        Broadcast(new ButtonStateEvent($counter_id));
    }
    
    public function getQueuesInfo()
    {
        $this->getCurrentQueue();
    }

    #[On('currentQueueUpdated')]
    public function getEventCurrentQueue($queueUpdated)
    {
        $this->nextQueue = $queueUpdated[0];
        $this->nextService = $queueUpdated[1];
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
