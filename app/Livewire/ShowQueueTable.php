<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Attributes\On; 

class ShowQueueTable extends Component
{
    public $user_id;
    public $data;

    public function mount()
    {
        $this->user_id;
        $this->getQueueTable();
    }

    #[On('user_id')]
    public function getUserId($id)
    {
        $this->user_id = $id;
    }

    public function getQueueTable()
    {
        $response = Http::get('http://localhost:8000/api/queues/users/' . $this->user_id);
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        // dd(var_dump($response['data'][0]));
        dd(var_dump(($response)));
        $this->dispatch('infoQueue', data:$this->data);
    }

    public function render()
    {
        return view('livewire.show-queue-table');
    }
}
