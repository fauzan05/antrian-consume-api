<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Attributes\On; 

class GetCurrentUser extends Component
{
    public $name;
    public $role;

    #[On('users')]
    public function getUser($data)
    {
        $this->name = $data['name'];
        $this->role = $data['role'];
    }

    public function render()
    {
        return view('livewire.get-current-user');
    }
}
