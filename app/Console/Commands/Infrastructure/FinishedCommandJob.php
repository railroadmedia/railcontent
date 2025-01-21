<?php

namespace App\Console\Commands\Infrastructure;

use Carbon\Carbon;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FinishedCommandJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Batchable;


    private string $commandName;
    private float $timeStart;

    public function __construct(string $commandName)
    {
        $this->commandName = $commandName;
        $this->timeStart = microtime(true);
    }

    public function handle(): void
    {
        $diff = microtime(true) - $this->timeStart;
        $sec = intval($diff);
        Log::info("Finished $this->commandName ($sec s)");
    }
}
