<?php

namespace App\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Console\Commands\Infrastructure\Timer;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Services\ChallengesService;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;

class MigrateChallengeV2Progress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MigrateChallengeV2Progress {startIndex=0} {limit=1000}';

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
    public function handle(ChallengesService $challengesService, SanityGateway $sanityGateway): int
    {
        $startIndex = (int)$this->argument('startIndex') ?? 0;
        $limit = (int)$this->argument('limit') ?? 0;
        $this->withExecutionTime(function () use ($sanityGateway, $challengesService, $startIndex, $limit) {
            $this->info("$this->name: $startIndex - $limit");
            try {
                $this->migrate($challengesService, $sanityGateway, $startIndex, $limit);
            } catch (\Throwable $exception) {
                \Log::error($exception->getMessage());
                return self::FAILURE;
            }
        });
        return self::SUCCESS;
    }

    public function migrate(
        ChallengesService $challengesService,
        SanityGateway $sanityGateway,
        $startIndex,
        $limit
    ): void {
        $this->info("$this->name: Test 1");

        $minId = 59000000;
        $maxId = 64800000;
        $this->info("$this->name: Test 2");

        $contentIdsByLessonId = [];
        $lessonIdsByChallenge = [];

        $challengesLookup = collect($sanityGateway->getAllByType('challenge', 1000))->keyBy('railcontent_id');
        $this->info("$this->name: Test 3");

        $challengeIdLookup = [
            402201 => 383674,
            402202 => 389065,
            402197 => 389228,
            402196 => 392886,
            402199 => 404048,
            404657 => 404800,
            413222 => 406312,
            409875 => 406383,
            410037 => 407309,
            410337 => 407962,
            410496 => 410409,
            412987 => 410537,
            412785 => 411082,
            414162 => 412431,
            414419 => 413049,
        ];

        $challengeIdReverseLookup = [
            383674 => 402201,
            389065 => 402202,
            389228 => 402197,
            392886 => 402196,
            404048 => 402199,
            404800 => 404657,
            406312 => 413222,
            406383 => 409875,
            407309 => 410037,
            407962 => 410337,
            410409 => 410496,
            410537 => 412987,
            411082 => 412785,
            412431 => 414162,
            413049 => 414419,
        ];
        $this->info("MigrateChallengeV2Progress:  Look up lessons");

        $lessonLookup = collect();
        foreach ($challengesLookup as $challenge) {
            $challengeId = $challenge['id'];
            $mappedChallengeId = $challengeIdLookup[$challenge['id']] ?? 0;
            foreach ($challenge['lessons'] as $lesson) {
                $lessonLookup[$lesson['id']] = $lesson;
                $ids = [$lesson['id']];
                if ($mappedChallengeId) {
                    $lessonId = $lesson['id'];
                    $slug = $lesson['slug'];
                    $title = str_replace("'", "''", $lesson['title']);
                    $query = "select c.id, c.slug, c.title from railcontent_content_hierarchy h inner join railcontent_content_hierarchy h2 on h.child_id = h2.parent_id
inner join railcontent_content c on h2.child_id = c.id
where h.parent_id = $mappedChallengeId and (c.slug = '$slug' || c.title = '$title')";
                    $oldContentId = \DB::select($query)[0]?->id ?? 0;
                    if ($oldContentId) {
                        $ids[] = $oldContentId;
                        $slug2 = \DB::select($query)[0]?->slug ?? 0;
                        $title2 = \DB::select($query)[0]?->title ?? 0;
                        $this->info("$lessonId $slug $title ==== $oldContentId $slug2, $title2");
                    } else {
                        $this->info("Unable to find related lesson for challenge $challengeId lesson $lessonId $slug");
                    }
                }


                $contentIdsByLessonId[$lesson['id']] = $ids;
                $lessonIdsByChallenge[$challenge['id']] = array_merge(
                    $ids,
                    $lessonIdsByChallenge[$challenge['id']] ?? []
                );
            }
        }




        $challengeIds = $challengesLookup->keys()->toArray();
        foreach ($challengeIds as $index => $challengeId) {
            $challengeIds[$index] = $challengeIdLookup[$challengeId] ?? $challengeId;
        }
        $userIds = User::query()->select('id')->skip($startIndex)->take($limit)->get()->pluck('id')->toArray();
        $challengesProgressLookup = ChallengeUserProgress::query()->whereIn('user_id', $userIds)->get()->keyBy(function ($userChallengeProgress) {
            return $userChallengeProgress->user_id . "_" . $userChallengeProgress->content_id;
        });
        $processed = 0;
        $total = count($userIds);
        $this->info("MigrateChallengeV2Progress:  $total users to process");
        foreach ($userIds as $userId) {
//            if ($processed < $startIndex) {
//                $processed++;
//                continue;
//            }
            Timer::afterSeconds(5, function () use ($processed, $total) {
                $this->info("MigrateChallengeV2Progress: Processed $processed/$total users");
            });
            $challengeUserProgressLookup = ContentUserProgress::query()
                ->where('user_id', $userId)
                ->where('id', '>=', $minId)
                ->where('id', '<', $maxId)
                ->where('updated_on', '>', '2024-11-16')
                ->whereIn('content_id', $challengeIds)
                ->get()
                ->keyBy('content_id');
            foreach ($challengeUserProgressLookup as $challengeId2 => $challengeProgressData) {
                $challengeId = $challengeIdReverseLookup[$challengeId2] ?? $challengeId2;
                if ($challengeProgressData->state != 'started') {
                    continue;
                }

                $challengeProgress = $challengesProgressLookup->get($userId . "_" . $challengeId);

                $challenge = $challengesLookup[$challengeId];

                $lessonIds = $lessonIdsByChallenge[$challenge['id']];

                $lessonCompletedLookup = ContentUserProgress::query()
                    ->where('user_id', $userId)
                    ->where('id', '>=', $minId)
                    ->whereIn('content_id', $lessonIds)
                    ->where('state', '=', 'completed')
                    ->get()
                    ->keyBy('content_id');

                $hasCompletedLessons = $lessonCompletedLookup->count() > 0;
                if ($hasCompletedLessons) {
                    if (!$challengeProgress) {
                        $this->info("MigrateChallengeV2Progress: Syncing Progress $userId $challengeId");
                        $challengeStartDate = Carbon::parse($challengeProgressData->started_on)->toDate();
                        try {
                            $challengeProgress = $challengesService->startChallenge(
                                $challengeId,
                                $userId,
                                startDate: $challengeStartDate,
                                isLocked: false,
                                challenge: $challenge,
                            );
                            sleep(1);
                        } catch (\Throwable $exception) {
                            $this->info("Error starting challenge user $userId challenge $challengeId");
                            $this->info($exception->getMessage());
                        }
                    }
                    if ($challengeProgress->is_locked) {
                        $this->info("MigrateChallengeV2Progress: Unlocking Challenge $userId $challengeId");
                        $challengesService->unlockChallenge($challengeId, $userId);
                    }

                    foreach ($challenge['lessons'] as $lesson) {
                        $contentIdsForLesson = $contentIdsByLessonId[$lesson['id']] ?? [];
                        foreach ($contentIdsForLesson as $contentId) {
                            $completedLesson = $lessonCompletedLookup[$contentId] ?? '';
                            if ($completedLesson) {
                                $completedLessonId = $lesson['id'];
                                try {
                                    $challengesService->completeLessonAndGetCurrentProgressResults(
                                        $completedLessonId,
                                        $userId,
                                        Carbon::parse($completedLesson->updated_on),
                                        $lesson,
                                        $challenge,
                                        $challengeProgress
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
                }
            }
            $processed++;
        }
    }
}
