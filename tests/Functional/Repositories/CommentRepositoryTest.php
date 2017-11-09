<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;


use Carbon\Carbon;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentRepositoryTest extends RailcontentTestCase
{
    /**
     * @var CommentRepository
     */
    protected $classBeingTested;

    /**
     * @var CommentFactory
     */
    protected $commentFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->commentFactory = $this->app->make(CommentFactory::class);
        $this->classBeingTested = $this->app->make(CommentRepository::class);
    }

    public function test_create_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $data = [
            'comment' => $this->faker->word,
            'content_id' => rand(),
            'user_id' => $userId,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $commentId = $this->classBeingTested->create($data);

        $this->assertDatabaseHas(
            ConfigService::$tableComments,
            array_merge(
                [
                    'id' => $commentId,
                ],
                $data
            )
        );
    }

    public function test_update_comment()
    {
        $oldComment = $this->commentFactory->create();

        $newComment = [
            'comment' => $this->faker->word
        ];;

        $this->classBeingTested->update($oldComment['id'], $newComment);

        $this->assertDatabaseHas(
            ConfigService::$tableComments,
            array_merge(
                $newComment,
                [
                    'id' => $oldComment['id'],
                ]
            )
        );
    }

    public function test_soft_delete_comment()
    {
        $comment = $this->commentFactory->create();

        $this->classBeingTested->delete($comment['id']);

        $this->assertSoftDeleted(
            ConfigService::$tableComments,
            [
                'id' => $comment['id'],
            ]
        );
    }

    public function test_soft_delete_comment_with_replies()
    {

        $comment = $this->commentFactory->create();
        $reply = $this->commentFactory->create($this->faker->word, $comment['content_id'], $comment['id']);

        $this->classBeingTested->delete($comment['id']);

        $this->assertDatabaseHas(
            ConfigService::$tableComments,
            [
                'id' => $comment['id'],
                'deleted_at' => Carbon::now()->toDateTimeString()
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableComments,
            [
                'id' => $reply['id'],
                'deleted_at' => Carbon::now()->toDateTimeString()
            ]
        );
    }

    public function test_delete_comment()
    {
        CommentRepository::$softDelete = false;

        $comment = $this->commentFactory->create();

        $this->classBeingTested->delete($comment['id']);

        $this->assertDatabaseMissing(
            ConfigService::$tableComments,
            [
                'id' => $comment['id']
            ]
        );
    }

    public function test_delete_comment_with_replies()
    {
        CommentRepository::$softDelete = false;

        $comment = $this->commentFactory->create();
        $reply = $this->commentFactory->create($this->faker->word, $comment['content_id'], $comment['id']);

        $this->classBeingTested->delete($comment['id']);

        $this->assertDatabaseMissing(
            ConfigService::$tableComments,
            [
                'id' => $comment['id']
            ]
        );

        $this->assertDatabaseMissing(
            ConfigService::$tableComments,
            [
                'id' => $reply['id']
            ]
        );
    }
}
