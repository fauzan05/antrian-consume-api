<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CounterQueueStatus extends Component
{
    public $data = [];

    public function mount()
    {
        $this->getCurrentQueue();
    }

    private function getCurrentQueue()
    {
        $response = Http::get('http://localhost:8000/api/counters/current-queue');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        // dd(var_dump($response));
        $this->data = $response['data'];
        // dd(var_dump($this->data));
    }
    public function render()
    {
        return view('livewire.counter-queue-status');
    }
}
