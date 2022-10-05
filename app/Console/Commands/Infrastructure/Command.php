<?php

namespace App\Console\Commands\Infrastructure;

use Illuminate\Console\Command as CommandBase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

abstract class Command extends CommandBase
{

    public function withProgressBarChunked(Builder $query, callable $function, $chunks = 1000, $timeout = 600): bool
    {
        $timeStart = microtime(true);

        $count = $query->count();
        $this->info("Processing query...");
        $this->info("$count records found.");

        $bar = null;
        if (App::environment('local')) { //progress bar not useful when running vapor commands
            $bar = $this->output->createProgressBar($count);
            $bar->setFormat('debug');
            $bar->start();
        }
        $n = 0;
        $success = $query->chunk($chunks, function ($items) use ($timeout, $timeStart, $count, &$n, $function, $bar) {
            $last = null;
            foreach ($items as $item) {
                call_user_func($function, $item);
                if ($bar) {
                    $bar->advance();
                }
                $last = $item;
                $sec = intval(microtime(true) - $timeStart);
                $n += 1;
                if ($sec >= $timeout) {
                    $this->info("Processing Timeout.  Processed $n/$count items.");
                    return false;
                }
            }
            if (!$bar) {
                $message = "$n/$count processed. ";
                if ($last?->id) {
                    $message .= "Last processed id: $last->id";
                }
                Log::info($message);
            }
        });

        $this->info("Processing Completed");
        return $success;
    }


    public function withBatched(callable $getJob, $chunks = 1000, $timeout = 600): bool
    {
        Artisan::call('queue:prune-batches');
        $timeStart = microtime(true);
        $job = call_user_func($getJob, 0, 0);
        $count = $job->getQuery()->count();
        $this->info("Processing query...");
        $this->info("$count records found.");

        $skip = 0;
        $take = $chunks;
        $jobs = [];
        while ($skip < $count) {
            if (($skip + $take) > $count) {
                $take = $count % $take;
            }
            $job = call_user_func($getJob, $skip, $take);
            $skip += $chunks;
            $jobs[] = $job;
        }
        $nJobs = count($jobs);
        $this->info("Dispatching $nJobs jobs.");
        $batch = Bus::batch($jobs)->name(class_basename($this))->dispatch();
        $this->info("Dispatched $nJobs jobs.");
        $this->info("Check batch status: artisan batch:status $batch->id");

        if (App::environment('local')) { //progress bar not useful when running vapor commands
            $batchId = $batch->id;
            while (!$batch->finished()) {
                $batch = Bus::findBatch($batchId);
                $completedJobs = $batch->totalJobs - $batch->pendingJobs;
                Log::info("Processed $completedJobs/$batch->totalJobs {$batch->progress()}%");
                usleep(500000);
            }
            Log::info("Processing Completed");
        }

        return true;
    }
}
