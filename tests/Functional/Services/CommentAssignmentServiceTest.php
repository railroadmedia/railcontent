<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;


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
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        unset($comment['replies']);
        $store = $this->classBeingTested->store($comment, $content['type']);

        $this->assertEquals([$comment['id'] => $comment], $store);
    }

    public function test_delete_comment_assignation_when_not_exist()
    {
        $results = $this->classBeingTested->deleteCommentAssignation(rand(), rand());

        $this->assertNull($results);
    }

    public function test_delete_comment_assignation()
    {
        $userId = ConfigService::$commentsAssignationOwnerIds['course'];

        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );

        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        $this->commentAssignationFactory->create($comment, 'course');

        $results = $this->classBeingTested->deleteCommentAssignation($comment['id'], $userId);

        $this->assertTrue($results);
    }
}
