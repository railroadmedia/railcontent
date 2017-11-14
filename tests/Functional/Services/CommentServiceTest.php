<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;


use Carbon\Carbon;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentServiceTest extends RailcontentTestCase
{
    /**
     * @var CommentService
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

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(CommentService::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->commentFactory = $this->app->make(CommentFactory::class);
    }

    public function test_get_comment()
    {
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());

        $result = $this->classBeingTested->get($comment['id']);

        $this->assertEquals($comment, $result);
    }

    public function test_get_inexistent_comment()
    {
        $result = $this->classBeingTested->get(rand());

        $this->assertNull($result);
    }

    public function test_create_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );

        $comment = [
            'id' => 1,
            'content_id' => $content['id'],
            'parent_id' => null,
            'user_id' => $userId,
            'comment' => $this->faker->text,
            'created_on' => Carbon::now()->toDateTimeString(),
            'deleted_at' => null
        ];
        $result = $this->classBeingTested->create($comment['comment'], $content['id'], $comment['parent_id'], $userId);

        $this->assertEquals($comment, $result);
    }

    public function test_create_comment_on_not_commentable_content_type()
    {
        $result = $this->classBeingTested->create($this->faker->text, rand(), null, rand());

        $this->assertNull($result);
    }

    public function test_create_comment_reply()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        $reply = [
            'id' => 2,
            'content_id' => $content['id'],
            'parent_id' => $comment['id'],
            'user_id' => $userId,
            'comment' => $this->faker->text,
            'created_on' => Carbon::now()->toDateTimeString(),
            'deleted_at' => null
        ];

        $result = $this->classBeingTested->create($reply['comment'], null, $comment['id'], $userId);

        $this->assertEquals($reply, $result);
    }

    public function test_update_my_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, $userId);

        $newCommentValues = [
            'comment' => $this->faker->text
        ];
        $result = $this->classBeingTested->update($comment['id'], $newCommentValues);

        $this->assertEquals(array_merge($comment, $newCommentValues), $result);
    }

    public function test_update_inexisting_comment()
    {
        $result = $this->classBeingTested->update(rand(), []);

        $this->assertNull($result);
    }

    public function test_update_others_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        CommentService::$canManageOtherComments = false;
        
        $newCommentValues = [
            'comment' => $this->faker->text
        ];
        $result = $this->classBeingTested->update($comment['id'], $newCommentValues);

        $this->assertEquals(-1, $result);
    }

    public function test_delete_my_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, $userId);

        $result = $this->classBeingTested->delete($comment['id']);

        $this->assertEquals(1, $result);
    }

    public function test_delete_inexistent_comment()
    {
        $result = $this->classBeingTested->delete(rand());

        $this->assertNull($result);
    }

    public function test_delete_other_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());

        $result = $this->classBeingTested->delete($comment['id']);

        $this->assertEquals(-1, $result);
    }

    public function test_get_comment_when_not_exist()
    {
        $results = $this->classBeingTested->getComments(1, 10, 'id');
        $this->assertArrayHasKey('results',$results);
        $this->assertArrayHasKey('total_results',$results);

        $this->assertEquals(0, $results['total_results']);
        $this->assertEquals([], $results['results']);
    }

    public function test_get_comments_paginated()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $limit = 3;

        $totalNumber = $this->faker->numberBetween($limit, ($limit+5));
        for($i = 0; $i<$totalNumber; $i++) {
            $comment[] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        }

        $results = $this->classBeingTested->getComments(1, $limit, 'id');

        $this->assertEquals($totalNumber, $results['total_results']);
        $this->assertEquals(array_slice($comment, 0, $limit, true), $results['results']);
    }

}
