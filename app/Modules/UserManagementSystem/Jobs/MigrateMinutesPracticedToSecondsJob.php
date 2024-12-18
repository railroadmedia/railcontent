<?php

namespace App\Modules\UserManagementSystem\Jobs;

use App\Modules\Brand\Enums\Brand;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\UserManagementSystem\Models\User;

class MigrateMinutesPracticedToSecondsJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Batchable;

    private int $skip;
    private int $take;

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    public function __construct(private readonly int $firstId, private readonly int $lastId)
    {
    }

    public function handle(): void
    {
        $users = User::query()
            ->withoutDeleted()
            ->whereBetween('id', [$this->firstId, $this->lastId])
            ->get();

        foreach ($users as $user) {
            $userBrandMinutesPracticed = $user->brand_minutes_practiced;

            foreach (Brand::values() as $brand) {
                if (array_key_exists($brand, $userBrandMinutesPracticed)) {
                    $min = $userBrandMinutesPracticed[$brand] ?? 0;
                    $userBrandMinutesPracticed[$brand] = $min * 60;
                }
            }
            $user->brand_seconds_practiced = $userBrandMinutesPracticed;
            $user->save();
        }
    }
}
