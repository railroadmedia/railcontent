<?php

namespace App\Modules\UserManagementSystem\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\UserManagementSystem\Jobs\SyncPrimaryBrandJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class SyncPrimaryBrand extends Command
{
    protected $signature = 'user:syncPrimaryBrand';
    protected $description = 'Sync new primary_brand column for all users with active subscriptions';

    public function handle(): void
    {
        $jobs = [];
        User::query()
            ->whereHas('onboardingAnswerHistory', function ($query) {
                $query->where('onboarding_question', 'instrument');
            })
            ->whereNull('primary_brand')
            ->select('id')
            ->orderBy('id')
            ->chunkById(500, function (Collection $users) use (&$jobs) {
                $jobs[] = new SyncPrimaryBrandJob($users->first()->id, $users->last()->id);
            });
        $startAt = now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(sprintf("SyncPrimaryBrand: completed in %s seconds", $startAt->diffInSeconds()));
            })->catch(function (Batch $batch, \Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();

        $this->info(
            sprintf(
                "SyncPrimaryBrand: Batch ID %s dispatched.",
                $batch->id
            )
        );
    }
}
