<?php

namespace App\Http\Controllers;

use App\Services\QueueDispatcher\Dispatcher;
use Exception;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Http\JsonResponse;
use Illuminate\Queue\QueueManager;

class QueueController extends Controller
{
    public function push(): JsonResponse
    {
        $exampleData = [
            'name' => 'John Doe',
            'age' => 25,
            'country' => 'BR'
        ];

        try {
            $dispatcher = new Dispatcher($this->queue());

            $dispatcher->push('jobName', $exampleData, 'queueName');

            return response()->json([
                'message' => 'Data dispatched!',
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something went terribly wrong',
                'exception' => $exception->getMessage(),
                'debug' => $exception->getTrace(),
            ], 500);
        }
    }

    public function pushRaw(): JsonResponse
    {
        $exampleData = [
            'name' => 'Jane Doe',
            'age' => 23,
            'country' => 'US'
        ];

        try {
            $dispatcher = new Dispatcher($this->queue());
            $dispatcher->pushRaw($exampleData, 'queueName');

            return response()->json([
                'message' => 'Raw data dispatched!',
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something went terribly wrong',
                'exception' => $exception->getMessage(),
                'debug' => $exception->getTrace(),
            ], 500);
        }
    }

    public function pop(): JsonResponse
    {
        $queue = $this->queue();
        $dispatcher = new Dispatcher($queue);

        $job = $dispatcher->pop('queueName');

        if ($job === null) {
            return response()->json([
                'message' => 'There is no more jobs available',
            ]);
        }

        $payload = $job->getRawBody();

        $job->delete();

        return response()->json([
            'payload' => json_decode($payload, true),
        ]);
    }

    private function queue(): Queue
    {
        $queueManager = app()->make(QueueManager::class);
        return $queueManager->connection('database');
    }
}
