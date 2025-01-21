<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Services\ChallengesService;
use Illuminate\Support\Carbon;

class ChallengesProcessSoloNotifications extends Command
{
    protected $name = 'ChallengesProcessSoloNotifications';
    protected $signature = 'challenges:processSoloNotifications';
    protected $description = 'Trigger Solo Notifications for any Solo Challenges that Start Today';

    public function handle(
        ChallengesService $challengesService,

    ): void {
        $userProgresses = ChallengeUserProgress::query()
            ->solo()
            ->where('solo_notification_to_be_processed', '=', 1)
            ->whereDate('start_date', '<=', Carbon::today())
            ->get();
        $count = count($userProgresses);
        foreach($userProgresses as $progress) {
                $challengesService->enableNotificationsForSoloChallengeAndClearProcessFlag($progress);
        }
        $this->info("Processed all ($count) Solo Challenges notifications where users start today");
    }
}
