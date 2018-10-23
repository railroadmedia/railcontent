<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\CommentCreated;
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

        $this->assertTrue($result->isEmpty());
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
            'user_id' => rand(),
            'comment' => $this->faker->text,
            'created_on' => Carbon::now()
                ->toDateTimeString(),
            'deleted_at' => null,
            'display_name' => $this->faker->word,
        ];
        $result = $this->classBeingTested->create(
            $comment['comment'],
            $content['id'],
            $comment['parent_id'],
            $comment['user_id'],
            $comment['display_name']
        )
            ->getArrayCopy();

        $this->assertArraySubset(array_add($comment, 'replies', []), $result);
    }

    public function test_comment_assignation()
    {
        Event::fake();

        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );

        $comment = [
            'comment' => $this->faker->text,
            'content_id' => $content['id'],
            'created_on' => Carbon::now()
                ->toDateTimeString(),
            'deleted_at' => null,
            'id' => 1,
            'parent_id' => null,
            'user_id' => $userId,
            'display_name' => $this->faker->word,
            'replies' => null,
        ];

        $result = $this->classBeingTested->create(
            $comment['comment'],
            $content['id'],
            $comment['parent_id'],
            $userId,
            $comment['display_name']
        );

        //check that the ContentCreated event was dispatched with the correct content id
        Event::assertDispatched(
            CommentCreated::class,
            function ($event) use ($comment, $content) {
                return (($event->commentId == $comment['id']));
            }
        );
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
            'created_on' => Carbon::now()
                ->toDateTimeString(),
            'deleted_at' => null,
            'display_name' => $this->faker->word,
        ];

        $result =
            $this->classBeingTested->create($reply['comment'], null, $comment['id'], $userId, $reply['display_name'])
                ->getArrayCopy();

        $this->assertArraySubset(array_add($reply, 'replies', []), $result);
    }

    public function test_update_my_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment =
            $this->commentFactory->create($this->faker->text, $content['id'], null, $userId)
                ->getArrayCopy();

        $newCommentValues = [
            'comment' => $this->faker->text,
        ];
        $result =
            $this->classBeingTested->update($comment['id'], $newCommentValues)
                ->getArrayCopy();

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
            'comment' => $this->faker->text,
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
        request()->attributes->set('user_id', $userId);
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

        $this->assertArrayHasKey('results', $results);
        $this->assertArrayHasKey('total_results', $results);

        $this->assertEquals(0, $results['total_results']);
        $this->assertEquals([], $results['results']->toArray());
    }

    public function test_get_comments_paginated()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $limit = 3;

        $totalNumber = $this->faker->numberBetween($limit, ($limit + 5));
        for ($i = 0; $i <= $totalNumber; $i++) {
            $comment[$i] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
            $comment[$i]['replies'] = [];
        }

        $results = $this->classBeingTested->getComments(1, $limit, 'created_on');

        $this->assertEquals(($totalNumber + 1), $results['total_results']);
        $this->assertEquals(array_slice($comment, 0, $limit, true), $results['results']->toArray());
    }

    public function test_soft_delete_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, $userId);
        request()->attributes->set('user_id', $userId);

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

        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, $userId);

        $reply = $this->commentFactory->create($this->faker->word, $comment['content_id'], $comment['id']);
        request()->attributes->set('user_id', $userId);

        $this->classBeingTested->delete($comment['id']);

        $this->assertDatabaseHas(
            ConfigService::$tableComments,
            [
                'id' => $comment['id'],
                'deleted_at' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableComments,
            [
                'id' => $reply['id'],
                'deleted_at' => Carbon::now()
                    ->toDateTimeString(),
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
                'id' => $comment['id'],
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
                'id' => $comment['id'],
            ]
        );

        $this->assertDatabaseMissing(
            ConfigService::$tableComments,
            [
                'id' => $reply['id'],
            ]
        );
    }
}
