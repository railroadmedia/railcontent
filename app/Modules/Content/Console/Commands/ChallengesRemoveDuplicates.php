<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Services\ChallengesService;
use Illuminate\Support\Carbon;

class ChallengesRemoveDuplicates extends Command
{
    protected $name = 'ChallengesRemoveDuplicates';
    protected $signature = 'challenges:removeDuplicates';
    protected $description = 'Remove Any Duplicated content_id and user_id values';

    public function handle(
        ChallengesService $challengesService,

    ): void {
        $groupedProgress = ChallengeUserProgress::query()
            ->select('content_id', 'user_id', 'id')
            ->get()
            ->groupBy(['content_id', 'user_id']);
        $allIdsToDelete = [];
        foreach($groupedProgress as $challenge) {
            foreach($challenge as $users) {
                if (count($users) > 1) {
                    $toRemove = $users->slice(1)->all();
                    foreach($toRemove as $modelToRemove) {
                        $allIdsToDelete[] = $modelToRemove->id;
                    }
                }
            }
        }
        $duplicatesRemoved = ChallengeUserProgress::query()
            ->whereIn('id', $allIdsToDelete)
            ->delete();
        $this->info("Removed ($duplicatesRemoved) Challenge Data");
    }
}
