<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $currentPage = 'dashboard';
    public $user;
    public $token;
    public $appSettings = [];
    public $darkMode = false;
    public $sidebarCollapsed = false;
    
    protected $listeners = ['switchPage'];
    
    public function mount($user)
    {
        $this->user = $user;
        $this->token = Cookie::get('token');
        $this->darkMode = Cookie::get('dark_mode') === 'true';
        $this->loadAppSettings();
    }
    
    public function loadAppSettings()
    {
        $apiUrl = config('services.api_url');
        try {
            $response = Http::get($apiUrl . '/app');
            $data = $response->json();
            $this->appSettings = $data['data'] ?? [];
        } catch (\Exception $e) {
            $this->appSettings = [
                'name_of_health_institute' => 'Admin Dashboard',
                'selected_logo' => '',
                'address_of_health_institute' => '',
            ];
        }
    }
    
    public function switchPage($page)
    {
        $this->currentPage = $page;
    }
    
    public function toggleSidebar()
    {
        $this->sidebarCollapsed = !$this->sidebarCollapsed;
    }
    
    public function toggleDarkMode()
    {
        $this->darkMode = !$this->darkMode;
        Cookie::queue('dark_mode', $this->darkMode ? 'true' : 'false', 525600);
        $this->dispatch('dark-mode-toggled', darkMode: $this->darkMode);
    }
    
    public function logout()
    {
        $apiUrl = config('services.api_url');
        try {
            Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token
            ])->delete($apiUrl . '/users/logout');
        } catch (\Exception $e) {
            // Log error if needed
        }
        
        Cookie::queue(Cookie::forget('token'));
        return redirect('/login');
    }
    
    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
