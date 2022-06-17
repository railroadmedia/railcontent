<?php


use Carbon\Carbon;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ExpireCacheTest extends RailcontentTestCase
{
    /**
     * @var ContentFactory
     */
    private $contentFactory;

    /**
     * @var ContentService
     */
    private $contentService;

    public function setUp()
    {
        parent::setUp();
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentService = $this->app->make(ContentService::class);
    }

    public function _test_command()
    {
        CacheHelper::setPrefix();
        $type = $this->faker->word;

        $content1 = $this->contentFactory->create(
            ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
            $type,
            ContentService::STATUS_PUBLISHED,
            'en-US',
            ConfigService::$brand,
            null,
            Carbon::now()->addSeconds(30)->toDateTimeString());

        $results =  $this->contentService->getAllByType($type);

        $this->assertEquals(1, count(Cache::store(ConfigService::$cacheDriver)->getRedis()->keys(Cache::store(ConfigService::$cacheDriver)
            ->getPrefix().'content*')));

        $content2 = $this->contentFactory->create(
            ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
            $type,
            ContentService::STATUS_PUBLISHED,
            'en-US',
            ConfigService::$brand,
            null,
            Carbon::now()->toDateTimeString());

        $this->artisan('command:expireCache');

        $this->assertTrue(Cache::store(ConfigService::$cacheDriver)->has('expireCacheCommand'));
        $this->assertEquals(0, count(Cache::store(ConfigService::$cacheDriver)->getRedis()->keys('*contents*')));
        $this->assertEquals(3, count(Cache::store(ConfigService::$cacheDriver)->getRedis()->keys('*')));
    }
}
