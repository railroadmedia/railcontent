<?php

namespace App\Console\Commands\Infrastructure;

use Illuminate\Console\Command as CommandBase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

abstract class Command extends CommandBase
{

    public function withProgressBarChunked(Builder $query, callable $function, $chunks = 1000): void
    {
        $count = $query->count();
        $this->info("Processing query...");
        $this->info("$count records found.");

        $bar = null;
        if (App::environment('production')) {
            $bar = $this->output->createProgressBar($count);
            $bar->setFormat('debug');
            $bar->start();
        }
        $n = 0;
        $query->chunk($chunks, function ($items) use ($count, &$n, $function, $bar) {
            $last = null;
            foreach ($items as $item) {
                call_user_func($function, $item);
                if ($bar) $bar->advance();
                $last = $item;
            }
            $n += $items->count();
            $message = "$n/$count processed. ";
            if ($last?->id) $message .= "Last processed id: $last->id";
            Log::info($message);
        });

        $this->info("\nProcessing Completed");
    }
}
