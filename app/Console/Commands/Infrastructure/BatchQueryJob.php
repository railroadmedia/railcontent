<?php

namespace App\Console\Commands\Infrastructure;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

abstract class BatchQueryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    //There's an issue with storing base class constructor parameters in Jobs so we have to get the skip/take from the parent class
    abstract function getSkip(): int;

    abstract function getTake(): int;

    abstract function getQuery(): Builder;

    abstract function handleItem($item): void;

    public function handle()
    {
        $skip = $this->getSkip();
        $take = $this->getTake();
        $end = $skip + $take;
        $className = class_basename($this);
        Log::debug("Processing $className batch $skip-$end");
        $items = $this->getQuery()->skip($skip)->take($take)->get();
        foreach ($items as $item) {
            $this->handleItem($item);
        }
        Log::debug("Processed $className batch $skip-$end");
    }

    /**
     * The job failed to process.
     *
     * @param Throwable $exception
     */
    public
    function failed(
        Throwable $exception
    ) {
        error_log($exception);

        $this->fail($exception);
    }
}
