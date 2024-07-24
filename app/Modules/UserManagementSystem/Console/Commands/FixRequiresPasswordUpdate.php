<?php

namespace App\Modules\UserManagementSystem\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\UserManagementSystem\Jobs\FixRequiresPasswordUpdateJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class FixRequiresPasswordUpdate extends Command
{
    protected $signature = 'user:fixRequiresPasswordUpdate';
    protected $description = '';

    /**
     * @throws \Throwable
     */
    public function handle(): void
    {
        $jobs = [];
        User::query()
            ->where('requires_password_update', true)
            ->select('id')
            ->orderBy('id')
            ->chunkById(500, function (Collection $users) use (&$jobs) {
                $jobs[] = new FixRequiresPasswordUpdateJob($users->first()->id, $users->last()->id);
            });
        $startAt = now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(sprintf("FixRequiresPasswordUpdate: completed in %s seconds", $startAt->diffInSeconds()));
            })->catch(function (Batch $batch, \Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();

        $this->info(
            sprintf(
                "FixRequiresPasswordUpdate: Batch ID %s dispatched.",
                $batch->id
            )
        );
    }
}
