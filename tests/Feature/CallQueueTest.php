<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CallQueueTest extends TestCase
{
   public function testFirst()
   {
        $token = '16|2EW1LcD1HeJAkVlgUQRzq0rm6sW7ngtvlliwlcKr36eefe1d';
        $currentIdCounter = 1;
        $userId = 1;
        $queue = Http::get('http://localhost:8000/api/queues/users/' . $userId);
        $queue = json_decode($queue->body(), JSON_OBJECT_AS_ARRAY);
        self::assertCount(20, $queue['data']);
        for($i = 0; $i < count($queue['data']); $i++){
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ])->put('http://127.0.0.1:8000/api/queues/' . $queue['data'][$i]['id'], [
                'status' => 'called',
                'counter_id' => $currentIdCounter
            ]);
            if($response->unauthorized()){
                break;
            }
            Log::info(json_decode($response->body(), JSON_PRETTY_PRINT));
        }  
   }
}
