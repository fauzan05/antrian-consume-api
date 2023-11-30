<?php

namespace App\Livewire;

use App\Events\CurrentQueuesEvent;
use App\Events\QueuesEvent;
use App\Events\QueuesMenusEvent;
use Illuminate\Support\Facades\Broadcast;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;

class QueuesMenus extends Component
{
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
        ];
    }

    public function getQueuesInfo()
    {
        $this->getQueue();
        $this->getCurrentQueue();
    }
    public function panggil($id)
    {
        Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->put('http://127.0.0.1:8000/api/queues/' . $id, [
            'status' => 'called',
            'counter_id' => $this->counter_id
        ]);
        Broadcast(new QueuesMenusEvent());
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
