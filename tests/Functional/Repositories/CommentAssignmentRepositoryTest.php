<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;


use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\CommentAssignmentRepository;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentAssignmentRepositoryTest extends RailcontentTestCase
{
    /**
     * @var CommentAssignmentRepository
     */
    protected $classBeingTested;

    /**
     * @var CommentFactory
     */
    protected $commentFactory;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->commentFactory = $this->app->make(CommentFactory::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);

        $this->classBeingTested = $this->app->make(CommentAssignmentRepository::class);

        CommentRepository::$availableContentType = false;
        CommentRepository::$availableUserId = false;
        CommentRepository::$availableContentId = false;
        CommentAssignmentRepository::$availableAssociatedManagerId = false;
        CommentAssignmentRepository::$availableCommentId = false;
    }

    public function test_get_assigned_comments_empty()
    {
        CommentAssignmentRepository::$availableAssociatedManagerId = rand();
        $this->assertEquals([], $this->classBeingTested->getAssignedComments());
    }

    public function test_get_assigned_comments()
    {
        $oneContent = $this->contentFactory->create($this->faker->word, 'course', ContentService::STATUS_PUBLISHED);
        $otherContent = $this->contentFactory->create($this->faker->word, 'course lesson', ContentService::STATUS_PUBLISHED);

        for ($i = 1; $i <= 4; $i++) {
            $comments[$i] = $this->commentFactory->create($this->faker->text, $oneContent['id'], null, rand());
            unset($comments[$i]['replies']);
        }

        for ($i = 1; $i <= 4; $i++) {
            $otherContentComments[$i] = $this->commentFactory->create($this->faker->text, $otherContent['id'], null, rand());
        }

        CommentAssignmentRepository::$availableAssociatedManagerId = 1;
        $response = $this->classBeingTested->getAssignedComments();

        $this->assertEquals($comments, $response);
    }

    public function test_delete_comment_assignation()
    {
        $content = $this->contentFactory->create($this->faker->word, 'course', ContentService::STATUS_PUBLISHED);
        $managerId = ConfigService::$commentsAssignation[$content['type']];

        $comments = $this->commentFactory->create($this->faker->text, $content['id'], null, rand(2, 10));

        $results = $this->classBeingTested->deleteCommentAssignation($comments['id'], $managerId);

        $this->assertTrue($results);

        $this->assertDatabaseMissing(
            ConfigService::$tableCommentsAssignment,
            [
                'comment_id' => $comments['id'],
                'user_id' => $managerId]

        );
    }
}
