<?php

use App\Http\Controllers\AuthController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'getLogin']);
Route::post('/login', [AuthController::class, 'postLogin'])->middleware('authLogin');
Route::get('/operator', [AuthController::class, 'getOperatorView']);
Route::get('/admin', [AuthController::class, 'getAdminView']);
Route::get('/show-queue', function(){
    $queue = new Client();
    $url = 'http://127.0.0.1:8000/api/queues';
    $response = $queue->request('GET', $url);
    $responseBody = json_decode( $response->getBody() );
    return view('queue', compact('responseBody'));
});

