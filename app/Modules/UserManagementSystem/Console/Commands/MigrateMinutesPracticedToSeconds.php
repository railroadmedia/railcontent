<?php

namespace App\Modules\UserManagementSystem\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\UserManagementSystem\Jobs\MigrateMinutesPracticedToSecondsJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class MigrateMinutesPracticedToSeconds extends Command
{
    protected $signature = 'user:migrateMinutesPracticedToSeconds';
    protected $description = 'Update brand minutes practiced to seconds for users';

    public function handle(): void
    {
        $jobs = [];
        User::query()
            ->withoutDeleted()
            ->select('id')
            ->orderBy('id')
            ->chunkById(200, function (Collection $users) use (&$jobs) {
                $jobs[] = new MigrateMinutesPracticedToSecondsJob($users->first()->id, $users->last()->id);
            });
        $startAt = now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(sprintf("MigrateMinutesPracticedToSeconds: completed in %s seconds", $startAt->diffInSeconds()));
            })->catch(function (Batch $batch, \Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();

        $this->info(
            sprintf(
                "MigrateMinutesPracticedToSeconds: Batch ID %s dispatched.",
                $batch->id
            )
        );
    }
}
