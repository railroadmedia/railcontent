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

    public function test_command()
    {
        CacheHelper::setPrefix();
        $type = $this->faker->word;

        $content1 = $this->fakeContent(1,[
            'type' => $type,
            'status' => ContentService::STATUS_PUBLISHED,
            'brand' => config('railcontent.brand'),
            'publishedOn' => Carbon::now(),
            'userId' => null
        ]);

        $results =  $this->contentService->getAllByType($type);


        $this->artisan('command:expireCache');
        $this->assertTrue(Cache::store(ConfigService::$cacheDriver)->has('expireCacheCommand'));
        $this->assertEquals(0, count(Cache::store(ConfigService::$cacheDriver)->getRedis()->keys('*contents*')));

    }
}
