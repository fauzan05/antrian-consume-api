<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use PDF;

class QueueController extends Controller
{
    public function index()
    {
        return view('queues.display');
    }

    public function print(int $id)
    {
        $responses = Http::pool(fn (Pool $pool) => [
            $pool->get('http://localhost:8000/api/queues/' . $id),
            $pool->get('http://localhost:8000/api/admin/settings')
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
