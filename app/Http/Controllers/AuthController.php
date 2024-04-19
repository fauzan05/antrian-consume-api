<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    private $api_url;

    public function __construct(){
        $this->api_url = config('services.api_url');
    }

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
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $request->cookie('token')
        ])->get($this->api_url . '/users/current');
        if($response->unauthorized()){
            return redirect('/login');
        }
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        return view('dashboard.operator.home', ['user' => $response['data']]);
    }

    public function getAdminView(Request $request)
    {
        $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $request->cookie('token')
        ])->get($this->api_url . '/users/current');
        if($response->unauthorized()){
            return redirect('/login');
        }
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        return view('dashboard.admin.home', ['user' => $response['data']]);
    }

    public function logout(Request $request)
    {
        Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $request->cookie('token')
        ])->delete($this->api_url . '/users/logout');
        return redirect('login')->with('message', 'Berhasil Keluar');
    }

    public function unprocess()
    {
        return view('users.unprocessable');
    }

    public function operatorSettings(Request $request)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $request->cookie('token')
        ])->get($this->api_url . '/users/current');
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        return view('dashboard.operator.settings', ['user' => $response['data']]);
    }
}
