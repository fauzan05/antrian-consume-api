<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = Http::post('http://127.0.0.1:8000/api/users/login', [
            'username' => $request->username,
            'password' => $request->password
        ]);

        $error = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);

        if($response->unauthorized()){
            return redirect('login')->with('message_401', $error['error']['error_message']);
        }
        if($response->badRequest()){
            $username = $error['error']['error_message']['username'][0] ?? '';
            $password = $error['error']['error_message']['password'][0] ?? '';
            return redirect('login')->with('message_400',[$username, $password]);
        }
        

        return $next($request);
    }
}
