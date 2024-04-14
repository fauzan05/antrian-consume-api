<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Attributes\On;

class AdminUsersContent extends Component
{
    public $isEdit = false;
    public $userId;
    public $token;
    public $users;
    public $currentUser; // operator yang dipilih
    public $api_url;

    public function mount($token)
    {
        $this->token = $token;
        $this->api_url = config('services.api_url');
        $this->getAllUsers();
    }

    public function editUser($userId, $userName, $userUsername)
    {
        $user = [
            'id' => $userId,
            'name' => $userName,
            'username' => $userUsername,
        ];

        if($this->userId != $userId)
        {
            $this->isEdit = true;
            $this->userId = $userId;
            $this->currentUser = $user;
            $this->dispatch('user-updated', data: $user); // memperbaharui user ketika di klik lagi
        }else if($this->userId == $userId){
            $this->isEdit = $this->isEdit ? false : true;
            $this->userId = $userId;
            $this->currentUser = $user;
        }
    }

    #[On('user-has-updated')]
    public function getAllUsers()
    {
        $response = Http::get($this->api_url . '/users');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->users = $response['data'];
    }

    #[On('user-has-updated')]
    public function setSessionMessageUpdate($data)
    {
        session()->flash('status', ['message' => 'Berhasil mengubah ' . $data]);
    }

    #[On('user-has-deleted')]
    public function setSessionMessageDelete($data)
    {
        session()->flash('status', ['message' => 'Berhasil menghapus ' . $data]);
        $response = Http::get($this->api_url . '/users');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $this->users = $response['data'];
    }

    public function render()
    {
        return view('livewire.admin-users-content');
    }
}
