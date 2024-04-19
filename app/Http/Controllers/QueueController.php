<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use PDF;

class QueueController extends Controller
{
    private $api_url;

    public function __construct(){
        $this->api_url = config('services.api_url');
    }
    public function index()
    {
        return view('queues.display');
    }

    public function print(int $id)
    {
        $responses = Http::pool(fn (Pool $pool) => [
            $pool->get($this->api_url . '/queues/' . $id),
            $pool->get($this->api_url . '/app')
        ]);
        $responses[0] = json_decode($responses[0]->body(), JSON_OBJECT_AS_ARRAY);
        $responses[1] = json_decode($responses[1]->body(), JSON_OBJECT_AS_ARRAY);
        $selected_queue = $responses[0]['data'];
        $app_settings = $responses[1]['data'];
        $pdf = PDF::loadView("queues.print-queue", [
            'selected_queue' => $selected_queue,
            'app_settings' => $app_settings
        ])->setPaper('a7')->setOrientation('portrait');
        return $pdf->download('tiket-antrian.pdf');
    }
}
