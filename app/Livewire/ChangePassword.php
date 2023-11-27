<?php

namespace App\Livewire;

use Livewire\Component;

class ChangePassword extends Component
{
    public $token;
    public function mount($token)
    {
        $this->token = $token;
    }
    public function render()
    {
        return view('livewire.change-password');
    }
}
