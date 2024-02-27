<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Cookie;

class MenuController extends Component
{
    public $active = 1;
    public $currentUser;
    public $token;
    public $darkMode;
    public $closed = false;
    public $name_of_institute;
    public $address;
    public function mount($user, $token, $darkMode)
    {
        $this->currentUser = $user;
        $this->token = $token;
        $this->darkMode = (boolean)$darkMode;
        $this->getAppSettings();
    }

    public function isClosed($active)
    {
        if ($this->closed) {
            $this->active = $active;
            $this->closed = false;
        } else {
            $this->active = $active;
            $this->closed = true;
        }
    }

    public function darkModes($active)
    {
        $this->darkMode = $this->darkMode ? false : true;
        $this->darkMode ? Cookie::queue('dark-mode', true) : Cookie::queue('dark-mode', false);
        if ($this->darkMode) {
            $this->active = $active;
        } else {
            $this->active = $active;
        }
    }

    public function getAppSettings()
    {
        $response = Http::get('http://127.0.0.1:8000/api/admin/settings');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->name_of_institute = $response['data']['name_of_health_institute'];
        $this->address = $response['data']['address_of_health_institute'];
    }

    public function countIndexMenu($index)
    {
        $this->active = (integer)$index;
        session()->forget('status');
    }

    public function logout()
    {
        Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->delete('http://127.0.0.1:8000/api/users/logout');
        $this->redirect('/login');
    }

    public function render()
    {
        return view('livewire.menu-controller');
    }
}
