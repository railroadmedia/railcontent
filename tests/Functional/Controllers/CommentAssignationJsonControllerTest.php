<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;


use Railroad\Railcontent\Factories\CommentAssignationFactory;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentAssignationJsonControllerTest extends RailcontentTestCase
{
    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var CommentFactory
     */
    protected $commentFactory;

    /**
     * @var CommentAssignationFactory
     */
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

        $expectedResults = $this->createPaginatedExpectedResult('ok', 200, 1, 10, 0, [], []);
        $this->assertEquals($expectedResults, $response->decodeResponseJson());
    }

    public function test_pull_my_assigned_comments()
    {
        $userId = $this->faker->randomElement(ConfigService::$commentsAssignationOwnerIds);
        $assignedComments = [];
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        for ($i = 0; $i < 5; $i++) {
            $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
            $assignedComments[$i] = $this->commentAssignationFactory->create($comment['id'], $userId);
            $assignedComments[$i]['deleted_at'] = null;
            $assignedComments[$i]['content_id'] = $comment['content_id'];
            $assignedComments[$i]['comment'] = $comment['comment'];
            $assignedComments[$i]['user_id'] = $comment['user_id'];
            $assignedComments[$i]['parent_id'] = $comment['parent_id'];
            $assignedComments[$i]['display_name'] = $comment['display_name'];
            $assignedComments[$i]['created_on'] = $comment['created_on'];
            unset($assignedComments[$i]['comment_id']);
            unset($assignedComments[$i]['assigned_on']);
        }

        $response = $this->call('GET', 'railcontent/assigned-comments',['user_id' => $userId]);

        $this->assertEquals(200, $response->getStatusCode());

        $expectedResults = $this->createPaginatedExpectedResult('ok', 200, 1,10, 5, $assignedComments, []);
        $this->assertEquals($expectedResults, $response->decodeResponseJson());
    }

    public function test_delete_assigned_comment()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        $assignedComments = $this->commentAssignationFactory->create($comment['id'], rand());

        $response = $this->call('DELETE', 'railcontent/assigned-comment/'.$comment['id']);

        $this->assertEquals(204, $response->getStatusCode());
    }
}
