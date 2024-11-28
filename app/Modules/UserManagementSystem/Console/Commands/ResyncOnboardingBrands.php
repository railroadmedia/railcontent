<?php

namespace App\Modules\UserManagementSystem\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\UserManagementSystem\Jobs\ResyncOnboardingBrandsJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class ResyncOnboardingBrands extends Command
{
    protected $signature = 'user:resyncOnboardingBrands';
    protected $description = 'Resync onboarding brands attributes to Customer.io for users who have it missing';

    public function handle(): void
    {
        $jobs = [];
        User::query()
            ->withoutDeleted()
            ->whereNotNull('membership_expiration_date')
            ->has('onboardingBrands')
            ->select('id')
            ->orderBy('id')
            ->chunkById(200, function (Collection $users) use (&$jobs) {
                $jobs[] = new ResyncOnboardingBrandsJob($users->first()->id, $users->last()->id);
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
