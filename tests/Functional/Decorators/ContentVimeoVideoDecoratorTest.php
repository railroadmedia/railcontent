<?php

namespace Railroad\Railcontent\Tests\Functional\Decorators;

use Railroad\Railcontent\Decorators\Video\ContentVimeoVideoDecorator;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentPermissionsFactory;
use Railroad\Railcontent\Factories\PermissionsFactory;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentVimeoVideoDecoratorTest extends RailcontentTestCase
{
    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentDatumFactory
     */
    protected $datumFactory;

    /**
     * @var ContentContentFieldFactory
     */
    protected $fieldFactory;

    /**
     * @var PermissionsFactory
     */
    protected $permissionFactory;

    /**
     * @var ContentPermissionsFactory
     */
    protected $contentPermissionsFactory;

    /**
     * @var ContentService
     */
    protected $serviceBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);

        $this->serviceBeingTested = $this->app->make(ContentService::class);
    }

    public function test_decorate()
    {
        $content = $this->contentFactory->create();
        $video = $this->contentFactory->create(
            ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
            'vimeo-video'
        );

        $videoField = $this->fieldFactory->create($content['id'], 'video', $video['id'], 1, 'content_id');
        $vimeoIdField = $this->fieldFactory->create(
            $video['id'],
            'vimeo_video_id',
            env('VIMEO_TEST_VIDEO_ID'),
            1,
            'string'
        );

        ConfigService::$decorators['content'] = [ContentVimeoVideoDecorator::class];

        $contentResults = $this->serviceBeingTested->getById($content['id']);

        $this->assertArrayHasKey(270, $contentResults['vimeo_video_playback_endpoints']);
        $this->assertArrayHasKey(360, $contentResults['vimeo_video_playback_endpoints']);
        $this->assertArrayHasKey(720, $contentResults['vimeo_video_playback_endpoints']);
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('cache.default', 'array');
    }
}
