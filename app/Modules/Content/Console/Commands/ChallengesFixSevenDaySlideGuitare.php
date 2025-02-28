<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Services\ChallengesService;
use Illuminate\Support\Carbon;

class ChallengesFixSevenDaySlideGuitare extends Command
{
    protected $name = 'ChallengesFixSevenDaySlideGuitare';
    protected $signature = 'challenges:fix7dsg';
    protected $description = 'Fix existing 7 day slide guitar data';

    public function handle(
        ChallengesService $challengesService,

    ): void {
        $allChallengesActive = ChallengeUserProgress::query()
            ->where('content_id', 410496)
            ->where('is_active', true)
            ->get();
        $count = 0;
        $correctIdFirst = 415820;
        $incorrectIdFirst = 415136;
        $correctIdLast = 416560;
        $incorrectIdLast = 415137;
        foreach ($allChallengesActive as $index => $challenge) {
            $metaData = $challenge->lessons_meta_data;
            $lessonId = $metaData[0]['content_id'];
            if ($lessonId == $incorrectIdFirst) {
                $metaData[0]['content_id'] = $correctIdFirst;
                $challenge->lessons_meta_data = $metaData;
                $challenge->save();
                $count++;
            }
            $lessonId = $metaData[8]['content_id'];
            if ($lessonId == $incorrectIdLast) {
                $metaData[8]['content_id'] = $correctIdLast;
                $challenge->lessons_meta_data = $metaData;
                $challenge->save();
                $count++;
            }
        }
        $this->info("Processed all ($count) 7 day slide guitar references that were incorrect");
    }
}
