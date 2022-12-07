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

    public function info($string, $verbosity = null)
    {
        Log::info($string); //also write info statements to log
        $this->line($string, 'info', $verbosity);
    }

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

    /**
     * Function for chunking queries into jobs to avoid running into Lambda 15 minute execution limit
     */
    public function runBatchQuery(callable $getJob, $chunks = 1000): bool
    {
        return $this->runJobsQuery($getJob, false, $chunks);
    }

    /**
     * Function for chunking queries into a chain of jobs to avoid running into Lambda 15 minute execution limit
     *
     * Reverse process helps for issues when items are removed from the query after processing
     */
    public function runChainQuery(callable $getJob, $chunks = 1000, $reverseProcessJobs = false): bool
    {
        return $this->runJobsQuery($getJob, true, $chunks, $reverseProcessJobs);
    }

    private function runJobsQuery(callable $getJob, bool $isChain, $chunks = 1000, $reverseProcessJobs = false): bool
    {
        Artisan::call('queue:prune-batches');
        $timeStart = microtime(true);
        $job = call_user_func($getJob, 0, 0);
        $count = $job->getQuery()->count();
        $this->info("Processing $this->name query...");
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
        if ($nJobs == 0) {
            $this->info("No jobs to dispatch.");
            $diff = microtime(true) - $timeStart;
            $sec = intval($diff);
            $this->info("Finished $this->name ($sec s)");
            return true;
        }
        $this->info("Dispatching $nJobs jobs.");
        $batch = null;
        if ($reverseProcessJobs) {
            $jobs = array_reverse($jobs);
        }

        if ($isChain) {
            $jobs[] = new FinishedCommandJob($this->name);
            Bus::chain($jobs)->dispatch();
        } else {
            $batch = Bus::batch($jobs)->name(class_basename($this))->dispatch();
        }
        $this->info("Dispatched $nJobs jobs.");
        if ($batch) {
            $this->info("Check batch status: artisan batch:status $batch->id");
        } else {
            $this->info("No batched status available");
        }

        if (App::environment('local') && env(
                'QUEUE_CONNECTION'
            ) == 'sync') { //progress bar not useful when running vapor commands
            if ($batch) {
                $batchId = $batch->id;
                while (!$batch->finished()) {
                    $batch = Bus::findBatch($batchId);
                    $completedJobs = $batch->totalJobs - $batch->pendingJobs;
                    Log::info("Processed $completedJobs/$batch->totalJobs {$batch->progress()}%");
                    usleep(500000);
                }
            }
            $diff = microtime(true) - $timeStart;
            $sec = intval($diff);
            $this->info("Finished $this->name ($sec s)");
        }

        return true;
    }

    public function withExecutionTime(callable $function)
    {
        $this->info("Processing $this->name");

        $timeStart = microtime(true);

        call_user_func($function);

        $diff = microtime(true) - $timeStart;
        $sec = intval($diff);
        $this->info("Finished $this->name ($sec s)");
    }
}
