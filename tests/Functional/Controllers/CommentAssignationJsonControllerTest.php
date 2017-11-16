<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;


use Railroad\Railcontent\Factories\CommentAssignationFactory;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentAssignationJsonControllerTest extends RailcontentTestCase
{
    protected $contentFactory;

    protected $commentFactory;

    protected $commentAssignationFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->commentFactory = $this->app->make(CommentFactory::class);
        $this->commentAssignationFactory = $this->app->make(CommentAssignationFactory::class);
    }

    public function test_pull_my_assigned_comments_when_not_exists()
    {
        $this->createAndLogInNewUser();
        $response = $this->call('GET', 'railcontent/assigned-comments');

        $this->assertEquals(200, $response->getStatusCode());

        $expectedResults = $this->createExpectedResult('ok', 200, []);
        $this->assertEquals($expectedResults, $response->decodeResponseJson());
    }

    public function test_pull_my_assigned_comments()
    {
        $userId = ConfigService::$commentsAssignation['course'];
        $assignedComments = [];
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );

        for ($i = 1; $i < 5; $i++) {
            $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
            $assignedComments += $this->commentAssignationFactory->create($comment, 'course');
        }

        $response = $this->call('GET', 'railcontent/assigned-comments');

        $this->assertEquals(200, $response->getStatusCode());

        $expectedResults = $this->createExpectedResult('ok', 200, $assignedComments);
        $this->assertEquals($expectedResults, $response->decodeResponseJson());
    }

    public function test_delete_assigned_comment()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        $assignedComments = $this->commentAssignationFactory->create($comment, 'course');

        $response = $this->call('DELETE', 'railcontent/assigned-comment/'.$comment['id']);

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function test_delete_inexistent_assigned_comment()
    {
        $userId = $this->createAndLogInNewUser();

        $response = $this->call('DELETE', 'railcontent/assigned-comment/'.rand());

        $this->assertEquals(404, $response->getStatusCode());
        $response->assertJsonFragment(["Delete failed, the comment it's not assigned to your account."]);
    }
}
