<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Http;

class QueuesMenus extends Component
{
    public $token;
    public $user;
    public $queues;
    public $counters;
    public $remainQueue; // sisa antrian
    public $totalQueue; // total antrian
    public $currentQueue; // antrian sekarang
    public $nextQueue; // antrian selanjutnya
    public function mount($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
        $this->getCurrentQueue();
        $this->getQueue();
    }
    public function getQueue()
    {
        $response = Http::get('http://localhost:8000/api/queues/users/' . $this->user['id']);
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->queues = $response['data'];
        $this->process($this->queues);
    }
    public function process($data)
    {   
        $this->remainQueue = count(array_filter($data, function($var){
            return $var['status'] == 'waiting';
        }));
        $this->totalQueue = count($data);
        $this->currentQueue = count(array_filter($data, function($var){
            return $var['status'] == 'called';
        }));
        $this->nextQueue = $this->currentQueue + 1;
    }
    private function getCurrentQueue()
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
