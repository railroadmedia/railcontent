<?php

use Carbon\Carbon;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ExpireCacheTest extends RailcontentTestCase
{
    /**
     * @var ContentService
     */
    private $contentService;

    public function setUp()
    {
        parent::setUp();

        $this->contentService = $this->app->make(ContentService::class);
    }

    public function test_command()
    {
        $logger = new \Doctrine\ORM\Cache\Logging\StatisticsCacheLogger();

        $this->entityManager->getConfiguration()
            ->getSecondLevelCacheConfiguration()
            ->setCacheLogger($logger);

        $type = $this->faker->word;

        $content1 = $this->fakeContent(
            100,
            [
                'type' => $type,
                'status' => ContentService::STATUS_PUBLISHED,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
                'userId' => null
            ]
        );

        $this->contentService->getAllByType($type);

        $this->assertEquals(1, $logger->getRegionMissCount('pull'));
        $this->assertEquals(0, $logger->getRegionHitCount('pull'));

        $this->artisan('command:expireCache');

        //clear logger stats
        $logger->clearStats();

        $this->assertTrue(
            count(
                $this->entityManager->getConfiguration()
                    ->getMetadataCacheImpl()
                    ->getRedis()
                    ->keys('*expireCache*')
            ) > 0
        );

        $this->assertEquals(
            0,
            count(
                $this->entityManager->getConfiguration()
                    ->getMetadataCacheImpl()
                    ->getRedis()
                    ->keys('*entities.content*')
            )
        );

        $this->contentService->getAllByType($type);

        //assert cache entry not found; the cache was cleared
        $this->assertEquals(1, $logger->getRegionMissCount('pull'));
    }
}
