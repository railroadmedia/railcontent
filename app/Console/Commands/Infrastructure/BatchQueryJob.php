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

/**
 * Base Job class for chunking queries into jobs to avoid running into Lambda 15 minute execution limit
 */
abstract class BatchQueryJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Batchable;

    //There's an issue with storing base class constructor parameters in Jobs so we have to get the skip/take from the parent class
    abstract public function getSkip(): int;

    abstract public function getTake(): int;

    abstract public function getQuery(): Builder;

    abstract public function handleItem($item): void;

    public function handleAllItems($items): bool
    {
        return false;
    }

    public function handle()
    {
        if ($this->batch()?->cancelled()) {
            return;
        }
        $skip = $this->getSkip();
        $take = $this->getTake();
        $end = $skip + $take;
        $className = class_basename($this);
        Log::info("Processing $className job $skip-$end");
        $items = $this->getQuery()->skip($skip)->take($take)->get();
        if ($items->count() == 0) {
            Log::info("No items found.");
            return;
        }
        if (!$this->handleAllItems($items)) {
            foreach ($items as $item) {
                $this->handleItem($item);
            }
        }
        Log::info("Processed $className job $skip-$end");
    }

    /**
     * The job failed to process.
     *
     * @param Throwable $exception
     */
    public function failed(
        Throwable $exception
    ) {
        error_log($exception);

        $this->fail($exception);
    }
}
