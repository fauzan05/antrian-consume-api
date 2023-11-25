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
        if(empty($request->cookie('token'))){
            return redirect('login')->with('message_session', 'Sesi telah berakhir, silahkan login kembali');
        }
        $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $request->cookie('token')
            ])->get('http://localhost:8000/api/users/current');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        if(isset($response['message']) && $response['message'] == 'Unauthenticated.')
        {
            return redirect('login');
        }
        return view('dashboard.operator', ['user' => $response]);  
    }

    public function getAdminView()
    {
        return view('dashboard.admin');
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
}
