<?php

namespace App\Services\QueueDispatcher;

use Illuminate\Contracts\Queue\Job;
use Illuminate\Contracts\Queue\Queue;

class Dispatcher
{
    public function __construct(
        private Queue $queue
    )
    {
    }

    public function push(string $name, array $data, string $queue = null): void
    {
        $this->queue->push($name, $data, $queue);
    }

    public function pushRaw(array|string $data, string $queue = null): void
    {
        if (is_array($data)) {
            $data = json_encode($data);
        }

        $this->queue->pushRaw($data, $queue);
    }

    public function pop(string $queue = null): ?Job
    {
        return $this->queue->pop($queue);
    }
}
