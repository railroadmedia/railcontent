<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;


use Carbon\Carbon;
use Railroad\Railcontent\Factories\CommentAssignationFactory;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\CommentAssignmentService;
use Railroad\Railcontent\Services\ConfigService;
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

        $this->assertEquals([
            'id' => 1,
            'comment_id' => $comment['id'],
            'user_id' => $managerId,
            'assigned_on' => Carbon::now()->toDateTimeString()
        ], $store->getArrayCopy());
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
    }
}
