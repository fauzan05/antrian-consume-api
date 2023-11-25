<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On; 

use Livewire\Component;

class ShowQueueTable extends Component
{
    public $id;
    public $data;
    

    public function mount($idUser)
    {
        $this->id = $idUser;
        $this->getQueueTable();
    }

    public function getQueueTable()
    {
        $response = Http::get('http://127.0.0.1:8000/api/queues/users/' . $this->id);
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        // dd(var_dump($response['data'][0]));
        $this->data = $response['data'];
        
        $this->dispatch('infoQueue', data:$this->data);
    }

    public function render()
    {
        return view('livewire.show-queue-table');
    }
}
