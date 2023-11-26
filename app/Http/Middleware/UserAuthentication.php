<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class UserAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(empty($request->cookie('token'))){
            return redirect('login')->with('message_session', 'Sesi telah berakhir, silahkan login kembali');
        }
        $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $request->cookie('token')
            ])->get('http://localhost:8000/api/users/current');
        if($response->unauthorized())
        {
            return redirect('login');
        }
        return $next($request);
    }
}
