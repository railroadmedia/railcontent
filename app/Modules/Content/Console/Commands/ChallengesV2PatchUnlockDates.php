<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Services\ChallengesService;
use Carbon\Carbon;
use Exception;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\RailcontentV2DataSyncingService;

class ChallengesV2PatchUnlockDates extends Command
{
    protected $name = 'ChallengesV2PatchUnlockDates';
    protected $signature = 'challenges:patch-unlock-dates';
    protected $description = 'Patch All Unlock dates for 30 day drummer S2 and Iconic Chord Progressions';

    public function handle(
        ChallengesService $challengeService
    ): void {
        // go through both challenges
        // set the unlock date
        $drummerId = 415524;
        $guitareoId = 415525;
        foreach([$drummerId, $guitareoId] as $challengeId) {
            $allProgressData = ChallengeUserProgress::query()->where('content_id', $challengeId)->get();
            $totalEnrolledUsers = count($allProgressData);
            $challenge = $challengeService->getChallengeById($challengeId);
            $totalLessons = count($challenge['lessons']);
            foreach($allProgressData as $index => $progressDatum) {
                if ($index % 200 == 0) {
                    $this->info("Processed $index of $totalEnrolledUsers");
                }
                $lessonsMetaData = $progressDatum->lessons_meta_data;
                $lessons = $challenge['lessons'];
                for ($i = 0; $i < $totalLessons; $i++) {
                    $unlockDate = $lessons[$i]['published_on'];
                    $lessonsMetaData[$i]['unlock_date'] = $unlockDate;
                }
                $progressDatum->lessons_meta_data = $lessonsMetaData;
                $progressDatum->save();
            }
            $this->info("Processed for challenge id $challengeId ($drummerId is 30DDS2 $guitareoId is Iconic Chords)");
        }
    }
}
