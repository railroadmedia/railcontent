<?php

namespace App\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Console\Commands\Infrastructure\Timer;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Services\ChallengesService;
use Carbon\Carbon;

class MigrateChallengeV2Progress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MigrateChallengeV2Progress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MigrateChallengeV2Progress';


    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(ChallengesService $challengesService, SanityGateway $sanityGateway): void
    {
        $this->withExecutionTime(function () use ($sanityGateway, $challengesService) {
            $this->migrate($challengesService, $sanityGateway);
        });
    }

    public function migrate(ChallengesService $challengesService, SanityGateway $sanityGateway): void
    {
        $minId = 63500000; //lines up with Nov 16th
        $challengesProgressLookup = ChallengeUserProgress::all()->keyBy(function ($userChallengeProgress) {
            return $userChallengeProgress->user_id . "_" . $userChallengeProgress->content_id;
        });
        $challengesLookup = collect($sanityGateway->getAllByType('challenge'), 1000)->keyBy('railcontent_id');
        $lessonLookup = collect();
        foreach ($challengesLookup as $challenge) {
            foreach ($challenge['lessons'] as $lesson) {
                $lessonLookup[$lesson['id']] = $lesson;
            }
        }


        $challengeIds = $challengesLookup->keys()->toArray();
        $userIds = ContentUserProgress::query()
            ->selectRaw('distinct user_id')
            ->where('id', '>=', $minId)
            ->whereIn('content_id', $challengeIds)
            ->where('state', '=', 'started')
            ->orderBy('user_id')
            ->get()
            ->pluck('user_id')
            ->toArray();

        $processed = 0;
        $total = count($userIds);
        $this->info("MigrateChallengeV2Progress:  $total users to process");
        foreach ($userIds as $userId) {
            Timer::afterSeconds(5, function () use ($processed, $total) {
                $this->info("Processed $processed/$total users");
            });
            $challengeUserProgressLookup = ContentUserProgress::query()
                ->where('user_id', $userId)
                ->where('id', '>=', $minId)
                ->whereIn('content_id', $challengeIds)
                ->get()
                ->keyBy('content_id');
            foreach ($challengeUserProgressLookup as $challengeId => $challengeProgressData) {
                if ($challengeProgressData->state != 'started') {
                    continue;
                }

                $challengeProgress = $challengesProgressLookup->get($userId . "_" . $challengeId);

                $challenge = $challengesLookup[$challengeId];

                $lessonIds = collect($challenge['lessons'])->pluck('id')->toArray();
                $lessonCompletedLookup = ContentUserProgress::query()
                    ->where('user_id', $userId)
                    ->where('id', '>=', $minId)
                    ->whereIn('content_id', $lessonIds)
                    ->where('state', '=', 'completed')
                    ->get()
                    ->keyBy('content_id');

                $hasCompletedLessons = $lessonCompletedLookup->count() > 0;
                if ($hasCompletedLessons) {
                    if (!$challengeProgress){
                        $challengeStartDate = Carbon::parse($challengeProgressData->started_on)->toDate();
                        try {
                            $challengesService->startChallenge(
                                $challengeId,
                                $userId,
                                startDate: $challengeStartDate,
                                isLocked: false,
                                challenge: $challenge,
                            );
                        } catch (\Throwable $exception) {
                            $this->info("Error starting challenge user $userId challenge $challengeId");
                            $this->info($exception->getMessage());
                        }
                    }
                    foreach ($lessonCompletedLookup as $completedLessonId => $completedLesson) {
                        $lesson = $lessonLookup[$completedLessonId];
                        try {
                            $challengesService->completeLessonAndGetCurrentProgressResults(
                                $completedLessonId,
                                $userId,
                                Carbon::parse($completedLesson->updated_on),
                                $lesson,
                                $challenge
                            );
                        } catch (\Throwable $exception) {
                            $this->info(
                                "Error setting lesson completed for user $userId challenge $challengeId lesson $completedLessonId"
                            );
                            $this->info($exception->getMessage());
                        }
                    }
                }
            }
            $processed++;
        }
    }
}
