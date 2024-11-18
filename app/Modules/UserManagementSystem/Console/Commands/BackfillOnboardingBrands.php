<?php

namespace App\Modules\UserManagementSystem\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\UserManagementSystem\Jobs\BackfillOnboardingBrandsJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class BackfillOnboardingBrands extends Command
{
    protected $signature = 'user:backfillOnboardingBrands';
    protected $description = 'Backfill onboarding brands attributes to Customer.io';

    public function handle(): void
    {
        $jobs = [];
        User::query()
            ->where('membership_expiration_date', '<=', now())
            ->select('id')
            ->orderBy('id')
            ->chunkById(200, function (Collection $users) use (&$jobs) {
                $jobs[] = new BackfillOnboardingBrandsJob($users->first()->id, $users->last()->id);
            });
        $startAt = now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(sprintf("BackfillOnboardingBrands: completed in %s seconds", $startAt->diffInSeconds()));
            })->catch(function (Batch $batch, \Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();

        $this->info(
            sprintf(
                "BackfillOnboardingBrands: Batch ID %s dispatched.",
                $batch->id
            )
        );
    }
}
