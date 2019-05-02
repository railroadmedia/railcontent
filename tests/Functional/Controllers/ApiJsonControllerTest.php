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
            'api/railcontent/comments',
            [
                'content_id' => $content['id'],
            ]
        );

        $this->assertEquals(200, $response->status());
        $this->assertEquals($commentText, $response->decodeResponseJson('data')[0]['comment']);
    }
}
