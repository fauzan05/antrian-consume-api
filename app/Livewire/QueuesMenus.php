<?php

namespace App\Livewire;

use App\Jobs\CallQueueJob;
use Carbon\Carbon;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Broadcast;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class QueuesMenus extends Component
{
    public $isButtonDisabled = false;
    public $token;
    public $user;
    public $queues;
    public $counters;
    public $counter_id;
    public $remainQueue; // sisa antrian
    public $totalQueue; // total antrian
    public $currentQueue; // antrian sekarang
    public $nextQueue; // antrian selanjutnya
    public function mount($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
        $this->getCurrentQueue();
        $this->getCurrentIdCounter();
        $this->getQueue();
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
        $this->getQueue();
        $this->getCurrentQueue();
    }

    public function calling($id, $number, $service_name)
    {
        $this->isButtonDisabled = true;
        $data = [
            'id' => $id,
            'number' => $number,
            'service_name' => $service_name,
            'token' => $this->token,
            'counter_id' => $this->counter_id
        ];
        CallQueueJob::dispatch($data);
    }

    #[On('buttonState')]
    public function buttonState()
    {
        $this->isButtonDisabled = false;
    }

    public function getCurrentIdCounter()
    {
        $response = Http::get('http://localhost:8000/api/counters/users/' . $this->user['id']);
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->counter_id = $response['data']['id'];
    }
    public function getQueue()
    {
        $response = Http::get('http://localhost:8000/api/queues/users/' . $this->user['id']);
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        // dd($response->{'data'});
        $this->queues = $response['data'];
        $this->process($this->queues);
    }
    public function process($data)
    {
        $this->remainQueue = count(array_filter($data, function ($var) {
            return $var['status'] == 'waiting';
        }));
        $this->totalQueue = count($data);
        $this->currentQueue = count(array_filter($data, function ($var) {
            return $var['status'] == 'called';
        }));

        if ($this->totalQueue == $this->currentQueue) {
            $this->nextQueue = 0;
        } else {
            $this->nextQueue = $this->currentQueue + 1;
        }
    }
    public function getCurrentQueue()
    {
        $response = Http::get('http://localhost:8000/api/counters/current-queue');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->counters = $response['data'];
    }
    public function render()
    {
        return view('livewire.queues-menus');
    }
}
