<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Faker\ORM\Doctrine\Populator;
use Railroad\Railcontent\Entities\CommentAssignment;
use Railroad\Railcontent\Services\CommentAssignmentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentAssignmentServiceTest extends RailcontentTestCase
{

    /**
     * @var CommentAssignmentService
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->populator = new Populator($this->faker, $this->entityManager);

        $this->classBeingTested = $this->app->make(CommentAssignmentService::class);
    }

    public function test_store()
    {
        $managerId = $this->faker->randomElement(config('railcontent.comment_assignation_owner_ids'));
        $content = $this->fakeContent();
        $comment = $this->fakeComment();

        $store = $this->classBeingTested->store($comment[0]->getId(), $managerId);

        $this->assertEquals(
            $this->entityManager->getRepository(CommentAssignment::class)
                ->find(1),
            $store
        );
    }

    public function test_delete_comment_assignation_when_not_exist()
    {
        $results = $this->classBeingTested->deleteCommentAssignations(rand());

        $this->assertFalse($results);
    }

    public function test_delete_comment_assignation()
    {
        $userId = $this->faker->randomElement(config('railcontent.comment_assignation_owner_ids'));
        $this->fakeContent();
        $comment = $this->fakeComment();

        $this->fakeCommentAssignation(
            1,
            [
                'comment' => $comment[0],
                'userId' => $userId,
            ]
        );

        $results = $this->classBeingTested->deleteCommentAssignations($comment[0]->getId());

        $this->assertTrue($results);

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix'). 'comment_assignment',
            [
                'comment_id' => $comment[0]->getId(),
                'user_id' => $userId,
            ]

        );
    }

    public function test_get_assigned_comments()
    {
        $userId = $this->faker->randomElement(config('railcontent.comment_assignation_owner_ids'));
        $this->fakeContent();
        $comment = $this->fakeComment(5);
        $assignedNr = rand(2, 5);

        $this->fakeCommentAssignation(
            $assignedNr,
            [
                'comment' => $this->faker->randomElement($comment),
                'userId' => $userId,
            ]
        );
        $response = $this->classBeingTested->getAssignedCommentsForUser($userId, 1, 25, 'comment', 'asc');

        foreach ($response as $res) {
            $this->assertEquals($userId, $res->getUser()->getId());
        }

        $count = $this->classBeingTested->countAssignedCommentsForUser($userId);

        $this->assertEquals($assignedNr, $count);
    }

    public function test_get_assigned_comments_empty()
    {
        $this->assertEmpty($this->classBeingTested->getAssignedCommentsForUser(rand()));
    }
}
