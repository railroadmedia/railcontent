<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;


use Railroad\Railcontent\Factories\CommentAssignationFactory;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\CommentAssignmentRepository;
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
            $assignedComments = $this->commentAssignationFactory->create($comments[$i]['id'], $oneContent['type']);
        }

        for ($i = 1; $i <= 4; $i++) {
            $otherContentComments[$i] = $this->commentFactory->create($this->faker->text, $otherContent['id'], null, rand());
            $assignedComments = $this->commentAssignationFactory->create($otherContentComments[$i]['id'], $otherContent['type']);
        }

        CommentAssignmentRepository::$availableAssociatedManagerId = 1;

        $response = $this->classBeingTested->getAssignedComments();

        $this->assertEquals($comments, $response);
    }
}
