<?php

use App\Events\SimpleNotif;
use App\Events\TestingWebsockets;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\ServiceController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Broadcast;
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
Route::get('/operator', [AuthController::class, 'getOperatorView'])->middleware('userAuth');
Route::get('/operator/pengaturan', [AuthController::class, 'operatorSettings'])->middleware('userAuth');
Route::get('/admin', [AuthController::class, 'getAdminView']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/unprocess', [AuthController::class, 'unprocess']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/queues', [QueueController::class, 'index']);

Route::get('/error', function() {
    return response()->view('errors.500', [], 500);
});
