<?php

namespace App\Console\Commands\Infrastructure;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

abstract class Job implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Batchable;

    public string $name;
    public int $instance;

    public function __construct(Command $command, int $instance)
    {
        $this->name = $command->getName();
        $this->instance = $instance;
    }

    public function handle()
    {
        $timeStart = microtime(true);
        Log::info("$this->instance:$this->name Processing");
        $this->handleJob();
        $diff = microtime(true) - $timeStart;
        $sec = intval($diff);
        Log::info("$this->instance:$this->name Finished ($sec s)");
    }

    abstract public function handleJob();

    public function failed(Throwable $exception)
    {
        Log::error($exception);
        $this->fail($exception);
    }
}
