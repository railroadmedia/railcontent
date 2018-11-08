<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Factories\CommentAssignationFactory;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\CommentAssignmentService;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentAssignmentServiceTest extends RailcontentTestCase
{

    /**
     * @var CommentAssignmentService
     */
    protected $classBeingTested;

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

        $this->classBeingTested = $this->app->make(CommentAssignmentService::class);
    }

    public function test_store()
    {
        $managerId = $this->faker->randomElement(ConfigService::$commentsAssignationOwnerIds);
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());

        $store = $this->classBeingTested->store($comment['id'], $managerId);

        $this->assertEquals(
            [
                'id' => 1,
                'comment_id' => $comment['id'],
                'user_id' => $managerId,
                'assigned_on' => Carbon::now()
                    ->toDateTimeString(),
            ],
            $store->getArrayCopy()
        );
    }

    public function test_delete_comment_assignation_when_not_exist()
    {
        $results = $this->classBeingTested->deleteCommentAssignations(rand());

        $this->assertFalse($results);
    }

    public function test_delete_comment_assignation()
    {
        $userId = $this->faker->randomElement(ConfigService::$commentsAssignationOwnerIds);

        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );

        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        $this->commentAssignationFactory->create($comment['id'], $userId);

        $results = $this->classBeingTested->deleteCommentAssignations($comment['id']);

        $this->assertTrue($results);

        $this->assertDatabaseMissing(
            ConfigService::$tableCommentsAssignment,
            [
                'comment_id' => $comment['id'],
                'user_id' => $userId,
            ]

        );
    }

    public function test_get_assigned_comments()
    {
        $oneContent = $this->contentFactory->create($this->faker->word, 'course', ContentService::STATUS_PUBLISHED);
        $otherContent =
            $this->contentFactory->create($this->faker->word, 'course lesson', ContentService::STATUS_PUBLISHED);
        $userId = $this->faker->randomElement(ConfigService::$commentsAssignationOwnerIds);
        for ($i = 0; $i <= 4; $i++) {
            $comments[$i] = $this->commentFactory->create($this->faker->text, $oneContent['id'], null, rand());
            $assignedComments[$i] = $this->commentAssignationFactory->create($comments[$i]['id'], $userId);
            unset($comments[$i]['replies']);
            unset($comments[$i]['like_count']);
            unset($comments[$i]['like_users']);
            unset($comments[$i]['is_liked']);
        }

        $response = $this->classBeingTested->getAssignedCommentsForUser($userId, 1, 25, 'comment_id', 'asc');

        $this->assertEquals(array_pluck($comments, 'id'),
            $response->pluck('id')
                ->all()
        );
    }

    public function test_get_assigned_comments_empty()
    {
        $this->assertEmpty($this->classBeingTested->getAssignedCommentsForUser(rand()));
    }
}
