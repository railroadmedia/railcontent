<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;


use Railroad\Railcontent\Factories\CommentAssignationFactory;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\CommentAssignmentRepository;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Services\ConfigService;
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

    protected $commentAssignationFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->commentFactory = $this->app->make(CommentFactory::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->commentAssignationFactory = $this->app->make(CommentAssignationFactory::class);

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
        $userId = $this->createAndLogInNewUser();

        $oneContent = $this->contentFactory->create($this->faker->word, 'course');
        $otherContent = $this->contentFactory->create($this->faker->word, 'course lesson');

        for ($i = 1; $i <= 4; $i++) {
            $comments[$i] = $this->commentFactory->create($this->faker->text, $oneContent['id'], null, rand());
            $assignedComments = $this->commentAssignationFactory->create($comments[$i], $oneContent['type']);
            unset($comments[$i]['replies']);
        }

        for ($i = 1; $i <= 4; $i++) {
            $otherContentComments[$i] = $this->commentFactory->create($this->faker->text, $otherContent['id'], null, rand());
            $assignedComments2 = $this->commentAssignationFactory->create($otherContentComments[$i], $otherContent['type']);
        }

        CommentAssignmentRepository::$availableAssociatedManagerId = 1;

        $response = $this->classBeingTested->getAssignedComments();

        $this->assertEquals($comments, $response);
    }

    public function test_delete_comment_assignation()
    {
        $content = $this->contentFactory->create($this->faker->word, 'course');
        $comments = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        $assignedComments = $this->commentAssignationFactory->create($comments, $content['type']);

        $results = $this->classBeingTested->deleteCommentAssignation($comments['id'], 1);

        $this->assertTrue($results);

        $this->assertDatabaseMissing(
            ConfigService::$tableCommentsAssignment,
            [
                'comment_id' => $comments['id'],
                'user_id' => 1]

        );
    }
}
