<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ApiJsonControllerTest extends RailcontentTestCase
{
    /**
     * @var
     */
    protected $userId;

    /** @var  ContentFactory */
    protected $contentFactory;

    /**
     * @var ContentHierarchyFactory
     */
    protected $contentHierarchyFactory;

    /**
     * @var ContentContentFieldFactory
     */
    protected $contentFieldFactory;

    /**
     * @var ContentDatumFactory
     */
    protected $contentDataFactory;

    /**
     * @var CommentFactory
     */
    protected $commentFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentHierarchyFactory = $this->app->make(ContentHierarchyFactory::class);
        $this->commentFactory = $this->app->make(CommentFactory::class);
        $this->contentFieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->contentDataFactory = $this->app->make(ContentDatumFactory::class);

        $this->userId = $this->createAndLogInNewUser();
    }

    public function test_onboarding()
    {
        $contents[] = $this->contentFactory->create();
        $response = $this->call(
            'GET',
            'api/railcontent/onboarding'
        );

        $this->assertEquals(
            config('railcontent.onboardingContentIds'),
            array_pluck($response->decodeResponseJson(), 'id')
        );
    }

    public function test_shows()
    {
        $response = $this->call(
            'GET',
            'api/railcontent/shows'
        );
        $results = $response->decodeResponseJson();

        $this->assertEquals(200, $response->status());

        foreach ($results as $key => $result) {
            $this->assertTrue(array_key_exists($key, config('railcontent.shows')));
        }

    }

    public function test_strip_comments()
    {
        $content = $this->contentFactory->create(
            $this->faker->word,
            'course',
            ContentService::STATUS_PUBLISHED
        );
        $commentText = $this->faker->paragraph;

        $this->commentFactory->create('<p>' . $commentText . '</p>', $content['id']);

        $response = $this->call(
            'GET',
            'api/railcontent/comment',
            [
                'content_id' => $content['id'],
            ]
        );

        $this->assertEquals(200, $response->status());
        $this->assertEquals($commentText, $response->decodeResponseJson('data')[0]['comment']);
    }

    public function test_get_content_with_vimeo_endpoints()
    {
        $content = $this->contentFactory->create();
        $video = $this->contentFactory->create(
            ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
            'vimeo-video'
        );

        $description = $this->faker->paragraph;
        $this->contentDataFactory->create(
            $content['id'],
            'description',
            '<p>' . $description . '</p>&lt;',
            1
        );

        $this->contentFieldFactory->create($content['id'], 'video', $video['id'], 1, 'content_id');
        $this->contentFieldFactory->create(
            $video['id'],
            'vimeo_video_id',
            env('VIMEO_TEST_VIDEO_ID'),
            1,
            'string'
        );

        $response = $this->call(
            'GET',
            'api/railcontent/content/' . $content['id']
        );

        $this->assertArrayHasKey('related_lessons', $response->decodeResponseJson('data')[0]);
        $this->assertArrayHasKey('video_playback_endpoints', $response->decodeResponseJson('data')[0]);
        $this->assertArrayHasKey('video_poster_image_url', $response->decodeResponseJson('data')[0]);
        $this->assertEquals($description, $response->decodeResponseJson('data')[0]['data'][0]['value']);
    }

    public function test_get_content_for_download_with_vimeo_endpoints()
    {
        $content =
            $this->contentFactory->create(ContentHelper::slugify($this->faker->words(rand(2, 6), true)), 'course','published',
                'en',
                config('railcontent.brand'),
                null,
                Carbon::now()->toDateTimeString());

        $lesson =
            $this->contentFactory->create(
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)), 'course-part',
                'published',
                'en',
                config('railcontent.brand'),
                null,
                Carbon::now()->toDateTimeString(),
                $content['id']
            );

        $assignment =  $this->contentFactory->create(
            ContentHelper::slugify($this->faker->words(rand(2, 6), true)), 'assignment',
            'published',
            'en',
            config('railcontent.brand'),
            null,
            Carbon::now()->toDateTimeString(),
            $lesson['id']
        );

        $video = $this->contentFactory->create(
            ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
            'vimeo-video'
        );

        $description = $this->faker->paragraph;
        $this->contentDataFactory->create(
            $content['id'],
            'description',
            '<p>' . $description . '</p>&lt;',
            1
        );

        $this->contentFieldFactory->create($content['id'], 'video', $video['id'], 1, 'content_id');
        $this->contentFieldFactory->create(
            $video['id'],
            'vimeo_video_id',
            env('VIMEO_TEST_VIDEO_ID'),
            1,
            'string'
        );

        $this->contentFieldFactory->create($lesson['id'], 'video', $video['id'], 1, 'content_id');

        $response = $this->call(
            'GET',
            'api/railcontent/content/' . $content['id'],[
                'download' => true
            ]
        );

        $this->assertArrayHasKey('related_lessons', $response->decodeResponseJson('data')[0]);
        $this->assertArrayHasKey('video_playback_endpoints', $response->decodeResponseJson('data')[0]);
        $this->assertArrayHasKey('video_poster_image_url', $response->decodeResponseJson('data')[0]);
        $this->assertArrayHasKey('related_lessons', $response->decodeResponseJson('data')[0]['lessons'][0]);
        $this->assertArrayHasKey('video_playback_endpoints', $response->decodeResponseJson('data')[0]['lessons'][0]);
        $this->assertArrayHasKey('video_poster_image_url', $response->decodeResponseJson('data')[0]['lessons'][0]);

        $this->assertEquals($description, $response->decodeResponseJson('data')[0]['data'][0]['value']);
    }
}
