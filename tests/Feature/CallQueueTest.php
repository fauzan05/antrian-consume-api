<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class CallQueueTest extends TestCase
{
   public function testFirst()
   {
        $token = '1|n6JotfXATJ8GqsfXXR5XGXA2liLVL4T9ajOXVomt0ce9e7cb';
        $currentIdCounter = 1;
        $userId = 1;
        $queue = Http::get('http://localhost:8000/api/queues/users/' . $userId);
        $queue = json_decode($queue->body(), JSON_OBJECT_AS_ARRAY);
        self::assertCount(40, $queue['data']);
        for($i = 0; $i < count($queue['data']); $i++){
            Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ])->put('http://127.0.0.1:8000/api/queues/' . $queue['data'][$i]['id'], [
                'status' => 'called',
                'counter_id' => $currentIdCounter
            ]);
        }
        
   }
}
