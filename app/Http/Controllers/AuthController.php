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

    public function postLogin(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/users/login', [
            'username' => $request->username,
            'password' => $request->password
        ]);
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        if(!$response['data']['role']) {
            return view('users.unprocessable', ['data' => $response['error']['error_message']]);
        }
        $role = $response['data']['role'];
        if($role == 'operator'){
            Cookie::queue('token',  $response['token'], 1440);
            return redirect('operator')->with("token", $response['token']);
        }else {
            return redirect('admin');
        }
    }
    
    public function getOperatorView(Request $request)
    {
        if(empty($request->cookie('token'))){
            return redirect('login')->with('message_session', 'Sesi telah berakhir, silahkan login kembali');
        } 
        $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $request->cookie('token')
            ])->get('http://127.0.0.1:8000/api/users/current');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        return view('dashboard.operator', ['user' => $response]);  
    }

    public function getAdminView()
    {
        return view('dashboard.admin');
    }
}
