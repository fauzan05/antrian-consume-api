<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getLogin()
    {
        return view('users.login');
    }
    
    public function getOperatorView(Request $request)
    {
        return view('dashboard.operator.home');  
    }

    public function getAdminView()
    {
        return view('dashboard.admin.home');
    }

    public function logout(Request $request)
    {
       Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $request->cookie('token')
        ])->delete('http://localhost:8000/api/users/logout');
        return redirect('login')->with('message', 'Berhasil Keluar');
    }

    public function unprocess()
    {
        return view('users.unprocessable');
    }

    public function operatorSettings()
    {
        return view('dashboard.operator.settings');
    }
}
