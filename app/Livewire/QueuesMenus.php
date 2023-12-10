<?php

namespace App\Livewire;

use App\Jobs\CallQueueJob;
use Illuminate\Http\Client\Pool;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;

class QueuesMenus extends Component
{
    public $currentPage = 1;
    public $isButtonDisabled = false;
    public $token;
    public $serviceRole;
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
        $this->getQueue();
    }

    public function getListeners()
    {
        return [
            'echo:queues-menus-channel,QueuesMenusEvent' => 'getQueuesInfo',
            'echo:services-menus-channel,ServicesMenusEvent' => 'getQueuesInfo',
            // 'echo:button-state-channel,ButtonStateEvent' => 'getQueuesInfo'
        ];
    }

    public function getQueuesInfo()
    {
        $this->getQueue();
    }

    public function calling($id, $number, $service_name, $counter_id)
    {
        $this->isButtonDisabled = true;
            $data = [
                'id' => $id,
                'number' => $number,
                'service_name' => $service_name,
                'token' => $this->token,
                'counter_id' => $this->counter_id,
                'service_role' => $this->serviceRole
            ];
            CallQueueJob::dispatch($data)->onQueue('default');
    }

    public function getQueue()
    {
        $responses = Http::pool(fn (Pool $pool) => [
            $pool->get('http://localhost:8000/api/queues/users/' . $this->user['id'] . '/current-queue'),
            $pool->get('http://localhost:8000/api/counters/users/' . $this->user['id']),
            $pool->get('http://localhost:8000/api/queues/users/' . $this->user['id'] . '?page=' . $this->currentPage)
        ]);
        $responses[0] = json_decode($responses[0]->body(), JSON_OBJECT_AS_ARRAY);
        $responses[1] = json_decode($responses[1]->body(), JSON_OBJECT_AS_ARRAY);
        $responses[2] = json_decode($responses[2]->body(), JSON_OBJECT_AS_ARRAY);
        // dd($responses[2]['data_paginate']['data']);
        $this->counters = $responses[0]['data'];
        $this->counter_id = $responses[1]['data']['id'];
        $this->serviceRole = $responses[1]['data']['service']['role'];
        $this->queues = $responses[2]['data_paginate']['data'];
        // dd($this->counters);
        if (!$responses[2]['data']) {
            $this->remainQueue = 0;
            $this->totalQueue = 0;
            $this->currentQueue = 0;
            $this->nextQueue = 0;
        } else {
            // dd($responses[2]['data']);
            $this->process($responses[2]['data']);
        }
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

    #[On('buttonState')]
    public function getButtonState()
    {
        $this->isButtonDisabled = false;
    }

    #[On('page')]
    public function getPage($pageId)
    {
        $this->currentPage = $pageId;
    }

    public function render()
    {
        return view('livewire.queues-menus');
    }
}
