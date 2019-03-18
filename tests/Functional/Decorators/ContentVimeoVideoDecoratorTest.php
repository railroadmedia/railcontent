<?php

namespace Railroad\Railcontent\Tests\Functional\Decorators;

use Railroad\Railcontent\Decorators\Video\ContentVimeoVideoDecorator;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentVimeoVideoDecoratorTest extends RailcontentTestCase
{
    /**
     * @var ContentService
     */
    protected $serviceBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(ContentService::class);
    }

    public function test_decorate()
    {
        config(
            [
                'resora.decorators.content' => [ContentVimeoVideoDecorator::class,]
            ]
        );

        $vimeoVideo = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'type' => 'vimeo-video',
                'vimeoVideoId' => '146616887',
                'video' => null,
                'status' => 'published',
            ]
        );

        $content = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'type' => 'course',
                'status' => 'published',
                'video' => $vimeoVideo[0]->getId(),
            ]
        );

        $contentResults = $this->serviceBeingTested->getById($content[0]->getId());

        $this->assertArrayHasKey(270, $contentResults->getProperty('vimeo_video_playback_endpoints'));
        $this->assertArrayHasKey(360, $contentResults->getProperty('vimeo_video_playback_endpoints'));
        $this->assertArrayHasKey(720, $contentResults->getProperty('vimeo_video_playback_endpoints'));
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('cache.default', 'array');
    }
}
