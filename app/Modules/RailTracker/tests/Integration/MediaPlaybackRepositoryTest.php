<?php

namespace App\Modules\RailTracker\tests\Integration;

use App\Modules\RailTracker\Repositories\MediaPlaybackRepository;
use App\Modules\RailTracker\Services\MediaPlaybackService;
use App\Modules\RailTracker\tests\RailtrackerTestCase;
use Carbon\Carbon;

class MediaPlaybackRepositoryTest extends RailtrackerTestCase
{
    /**
     * @var MediaPlaybackRepository
     */
    private $mediaPlaybackRepository;

    /**
     * @var MediaPlaybackService
     */
    private $mediaPlaybackTracker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mediaPlaybackRepository = app(MediaPlaybackRepository::class);
        $this->mediaPlaybackTracker = app(MediaPlaybackService::class);
    }

    public function test_sum_total_played()
    {
        $userId = $this->createAndLogInNewUser();

        $mediaId = $this->faker->word . rand();
        $mediaLength = rand();
        $mediaType = $this->faker->word;
        $mediaCategory = $this->faker->word;

        $mediaTypeId = $this->mediaPlaybackTracker->trackMediaType($mediaType, $mediaCategory);

        $mostRecentUpdatedOn = null;

        $sumTimeWatched = 0;

        for ($i = 0; $i < 5; $i++) {
            $sessionId = $this->mediaPlaybackTracker->trackMediaPlaybackStart(
                $mediaId,
                $mediaLength,
                $userId,
                $mediaTypeId
            )['id'];

            $currentSecond = rand();
            $totalTimeWatched = rand();
            $sumTimeWatched += $totalTimeWatched;
            $updatedAt = Carbon::instance($this->faker->dateTime);

            $this->mediaPlaybackTracker->trackMediaPlaybackProgress(
                $sessionId,
                $totalTimeWatched,
                $currentSecond,
                $updatedAt
            );

            if (is_null($mostRecentUpdatedOn)) {
                $mostRecentUpdatedOn = $updatedAt;
                $mostRecentCurrentSecond = $currentSecond;
            }

            if ($updatedAt > $mostRecentUpdatedOn) {
                $mostRecentUpdatedOn = $updatedAt;
                $mostRecentCurrentSecond = $currentSecond;
            }
        }

        $response = $this->mediaPlaybackRepository->sumTotalPlayed(
            $userId,
            $mediaId,
            $mediaTypeId
        );

        $this->assertEquals($sumTimeWatched, $response);
    }
}
