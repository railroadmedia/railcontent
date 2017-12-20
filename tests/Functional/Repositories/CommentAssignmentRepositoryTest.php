<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;


use Railroad\Railcontent\Factories\CommentAssignationFactory;
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

    /**
     * @var CommentAssignationFactory
     */
    protected $commentAssignationFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->commentFactory = $this->app->make(CommentFactory::class);
        $this->commentAssignationFactory = $this->app->make(CommentAssignationFactory::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);

        $this->classBeingTested = $this->app->make(CommentAssignmentRepository::class);

        CommentRepository::$availableContentType = false;
        CommentRepository::$availableUserId = false;
        CommentRepository::$availableContentId = false;
      //  CommentAssignmentRepository::$availableAssociatedManagerId = false;
       // CommentAssignmentRepository::$availableCommentId = false;
    }

    public function get_assigned_comments_empty()
    {
        //CommentAssignmentRepository::$availableAssociatedManagerId = rand();
        $this->assertEquals([], $this->classBeingTested->getAssignedComments());
    }

    public function test_get_assigned_comments()
    {
        $oneContent = $this->contentFactory->create($this->faker->word, 'course', ContentService::STATUS_PUBLISHED);
        $otherContent = $this->contentFactory->create($this->faker->word, 'course lesson', ContentService::STATUS_PUBLISHED);
        $userId = $this->faker->randomElement(ConfigService::$commentsAssignationOwnerIds);
        for ($i = 0; $i <= 4; $i++) {
            $comments[$i] = $this->commentFactory->create($this->faker->text, $oneContent['id'], null, rand());
            $assignedComments[$i] = $this->commentAssignationFactory->create($comments[$i]['id'], $userId);
            unset($comments[$i]['replies']);
        }

        $response = $this->classBeingTested->getAssignedCommentsForUser($userId, 1,25,'comment_id','asc');

        $this->assertEquals($comments, $response);
    }

    public function test_delete_comment_assignation()
    {
        $content = $this->contentFactory->create($this->faker->word, 'course', ContentService::STATUS_PUBLISHED);
        $managerId = $this->faker->randomElement(ConfigService::$commentsAssignationOwnerIds);

        $comments = $this->commentFactory->create($this->faker->text, $content['id'], null, rand(2, 10));
        $assignedComment = $this->commentAssignationFactory->create($comments['id'], $managerId);

        $results = $this->classBeingTested->deleteCommentAssignations([$comments['id']]);

        $this->assertTrue($results);

        $this->assertDatabaseMissing(
            ConfigService::$tableCommentsAssignment,
            [
                'comment_id' => $comments['id'],
                'user_id' => $managerId]

        );
    }
}
