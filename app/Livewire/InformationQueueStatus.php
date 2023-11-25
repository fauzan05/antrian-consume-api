<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 

class InformationQueueStatus extends Component
{
    public $remainQueue; // sisa antrian
    public $totalQueue; // total antrian
    public $currentQueue; // antrian sekarang
    public $nextQueue; // antrian selanjutnya

    public function mount()
    {
        $this->remainQueue;
        $this->totalQueue;
        $this->currentQueue;
        $this->nextQueue;
    }
    
    #[On('infoQueue')]
    public function getData($data)
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
    
    public function render()
    {
        return view('livewire.information-queue-status');
    }
}
