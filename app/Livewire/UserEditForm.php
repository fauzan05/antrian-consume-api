<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;

class UserEditForm extends Component
{
    public $id;
    public $name;
    public $username;
    public $new_password;
    public $old_password;
    public $switch = false;
    public $new_password_confirmation;
    public $user;
    public $token;
    public $message;
    public $color;

    public function mount($user, $token)
    {
        $this->token = $token;
        $this->user = $user;
        $this->setCurrentEditForm();
    }
    
    public function switchs()
    {
        $this->switch = $this->switch ? false : true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:50',
            'username' => 'required|string|min:3|max:50',
            'old_password' => 'required|string|min:3|max:50',
            'new_password' => !$this->switch ? 'required|string|min:3|max:50' : 'nullable|string',
            'new_password_confirmation' => !$this->switch ? 'required|string|same:new_password|min:3|max:50' : 'nullable|string'
        ];
    }

    public function updateUser()
    {
        $this->rules();
        $this->validate();
        // dd($this->name, $this->username, $this->old_password, $this->new_password, $this->new_password_confirmation, $this->switch);
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->put('http://127.0.0.1:8000/api/users/' . $this->id, [
            'name' => $this->name,
            'username' => $this->username,
            'old_password' => $this->old_password,
            'new_password' => $this->new_password,
            'new_password_confirmation' => $this->new_password_confirmation
        ]);
        // dd($response->body());

        if ($response->unauthorized()) {
            if (!isset($response['message'])) {
                $this->color = true;
                $this->message = json_decode($response->body(), JSON_OBJECT_AS_ARRAY)['error']['error_message'];
                $this->reset('old_password', 'new_password', 'new_password_confirmation');
                return;
            } else {
                $this->color = true;
                $this->message = $response['message'];
                $this->reset('old_password', 'new_password', 'new_password_confirmation');
                return;
            }
        }
        if ($response->conflict()) {
            $this->color = true;
            $this->message = json_decode($response->body(), JSON_OBJECT_AS_ARRAY)['error']['error_message'];
            $this->reset('old_password', 'new_password', 'new_password_confirmation');
            return;
        }
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        session()->flash('status', ['page' => 4, 'message' => 'Berhasil mengubah ' . $this->name]);
        // session()->flash('status_update_user', ['color' => 'success', 'message' => 'Berhasil mengedit ' . $this->name]);
        // $this->reset('old_password', 'new_password', 'new_password_confirmation');
        // $this->dispatch('user-has-updated', data: $this->name);
        return $this->redirect('admin');
    }

    #[On('user-updated')]
    public function userUpdated($data)
    {
        unset($this->message);
        $this->user = $data;
        $this->setCurrentEditForm();
    }

    public function delete()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ])->delete('http://127.0.0.1:8000/api/users/' . $this->id);
        // dd($response->body());
        session()->flash('status', ['page' => 4, 'message' => 'Berhasil mengubah ' . $this->name]);
        return $this->redirect('admin', navigate: true);
    }

    public function setCurrentEditForm()
    {
        $this->id = $this->user['id'];
        $this->name = $this->user['name'];
        $this->username = $this->user['username'];
    }

    public function render()
    {
        return view('livewire.user-edit-form');
    }
}
