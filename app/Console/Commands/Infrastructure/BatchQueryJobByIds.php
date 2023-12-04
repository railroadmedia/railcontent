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
abstract class BatchQueryJobByIds extends BatchQueryJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public function init(int $skip, int $take)
    {
        $this->ids = $this->getQuery()->skip($skip)->take($take)->pluck('id')->toArray();
    }

    public
    function handle()
    {
        if ($this->batch()?->cancelled()) {
            return;
        }
        $skip = $this->getSkip();
        $take = $this->getTake();
        $end = $skip + $take;
        $className = class_basename($this);
        Log::info("Processing $className job $skip-$end");
        $items = $this->getQuery()->whereIn('id', $this->ids)->get();
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
}
