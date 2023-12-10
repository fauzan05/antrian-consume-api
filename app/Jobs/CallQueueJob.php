<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Events\CurrentQueuesEvent;
use App\Events\QueuesMenusEvent;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CallQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $id;
    public $number;
    public $service_name;
    public $token;
    public $counter_id;
    public $service_role;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->number = $data['number'];
        $this->service_name = $data['service_name'];
        $this->token = $data['token'];
        $this->counter_id = $data['counter_id'];
        $this->service_role = $data['service_role'];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ])->put('http://127.0.0.1:8000/api/queues/' . $this->id, [
            'status' => 'called',
            'counter_id' => $this->counter_id,
        ]);
        $response = json_decode($response->body(), JSON_OBJECT_AS_ARRAY);
        $data = [$this->number, $this->service_name, $this->counter_id, (($this->service_role == "poly") ? $response['data'][0]['link-audio-poly'] : $response['data'][0]['link-audio-registration'])];
        Broadcast(new QueuesMenusEvent());
        Broadcast(new CurrentQueuesEvent($data));
    }
}
