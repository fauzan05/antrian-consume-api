<?php

namespace App\Livewire;

use App\Events\ButtonStateEvent;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On; 

class QueuesDisplay extends Component
{
    public $nextQueue;
    public $nextService;
    public $currentQueues;
    public $text_footer_display;
    public $api_url;
    public function mount()
    {
        $this->api_url = config('services.api_url');
        $this->getCurrentQueue();
        $this->appSettings();
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
        $response = Http::get($this->api_url . '/queues/counters/current-queue');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->currentQueues = $response['data'];
    }

    public function appSettings()
    {
        $response = Http::get($this->api_url . '/admin/settings');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->text_footer_display = $response['data']['text_footer_display'];
    }
    public function render()
    {
        return view('livewire.queues-display');
    }
}
