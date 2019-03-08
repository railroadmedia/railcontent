<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\CommentCreated;
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

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(CommentService::class);
    }

    public function test_get_comment()
    {
        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ]
        );

        $comment = $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'comment' => $this->faker->paragraph,
            ]
        );

        $result = $this->classBeingTested->get($comment[0]->getId());

        $this->assertEquals($comment[0], $result);
    }

    public function test_get_inexistent_comment()
    {
        $result = $this->classBeingTested->get(rand());

        $this->assertNull($result);
    }

    public function test_create_comment()
    {
        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ]
        );

        $comment = [
            'id' => 1,
            'content_id' => $content[0]->getId(),
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
            $content[0]->getId(),
            $comment['parent_id'],
            $comment['user_id'],
            $comment['display_name']
        );

        $this->assertEquals($comment['id'], $result->getId());
        $this->assertEquals(
            $comment['content_id'],
            $result->getContent()
                ->getId()
        );
        $this->assertEquals($comment['comment'], $result->getComment());
        $this->assertEquals($comment['user_id'], $result->getUser()->getId());
        $this->assertEquals($comment['display_name'], $result->getTemporaryDisplayName());
    }

    public function test_comment_assignation()
    {
        Event::fake();

        $userId = $this->createAndLogInNewUser();
        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ]
        );

        $comment = [
            'comment' => $this->faker->text,
            'content_id' => $content[0]->getId(),
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
            $content[0]->getId(),
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
        $content = $this->fakeContent();

        $result = $this->classBeingTested->create($this->faker->text, $content[0]->getId(), null, rand());

        $this->assertNull($result);
    }

    public function test_create_comment_reply()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ]
        );

        $comment = $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'userId' => $userId,
                'comment' => $this->faker->text,
            ]
        );

        $reply = [
            'id' => 2,
            'content_id' => $content[0]->getId(),
            'parent_id' => $comment[0]->getId(),
            'user_id' => $userId,
            'comment' => $this->faker->text,
            'created_on' => Carbon::now()
                ->toDateTimeString(),
            'deleted_at' => null,
            'display_name' => $this->faker->word,
        ];

        $result = $this->classBeingTested->create(
            $reply['comment'],
            null,
            $comment[0]->getId(),
            $userId,
            $reply['display_name']
        );

        $this->assertEquals($reply['id'], $result->getId());
        $this->assertEquals(
            $reply['content_id'],
            $result->getContent()
                ->getId()
        );
        $this->assertEquals($reply['comment'], $result->getComment());
        $this->assertEquals($reply['user_id'], $result->getUser()->getId());
        $this->assertEquals($reply['display_name'], $result->getTemporaryDisplayName());

        $this->assertEquals($comment[0], $result->getParent());
    }

    public function test_update_my_comment()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ]
        );

        $comment = $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'userId' => $userId,
                'comment' => $this->faker->text,
            ]
        );

        $newCommentValues = [
            'data' => [
                'attributes' => [
                    'comment' => $this->faker->text,
                ],
            ],
        ];
        $result = $this->classBeingTested->update($comment[0]->getId(), $newCommentValues);

        $this->assertEquals($newCommentValues['data']['attributes']['comment'], $result->getComment());
    }

    public function test_update_inexisting_comment()
    {
        $result = $this->classBeingTested->update(rand(), []);

        $this->assertNull($result);
    }

    public function test_update_others_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ]
        );

        $comment = $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'userId' => rand(5, 100),
                'comment' => $this->faker->text,
            ]
        );
        CommentService::$canManageOtherComments = false;

        $newCommentValues = [
            'data' => [
                'attributes' => [
                    'comment' => $this->faker->text,
                ],
            ],
        ];
        $result = $this->classBeingTested->update($comment[0]->getId(), $newCommentValues);

        $this->assertEquals(-1, $result);
    }

    public function test_delete_my_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ]
        );

        $comment = $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'userId' => $userId,
                'comment' => $this->faker->text,
            ]
        );

        $result = $this->classBeingTested->delete($comment[0]->getId());

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
        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ]
        );

        $comment = $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'userId' => rand(3, 20),
                'comment' => $this->faker->text,
            ]
        );

        $result = $this->classBeingTested->delete($comment[0]->getId());

        $this->assertEquals(-1, $result);
    }

    public function test_get_comment_when_not_exist()
    {
        $results = $this->classBeingTested->getComments(1, 10, 'id');

        $this->assertEquals([], $results);
    }

    public function test_soft_delete_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ]
        );

        $comment = $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'userId' => $userId,
                'comment' => $this->faker->text,
            ]
        );

        $this->classBeingTested->delete($comment[0]->getId());

        $this->assertSoftDeleted(
            ConfigService::$tableComments,
            [
                'id' => $comment[0]->getId(),
            ]
        );
    }

    public function test_soft_delete_comment_with_replies()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ]
        );

        $comment = $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'userId' => $userId,
                'comment' => $this->faker->text,
            ]
        );

        $reply = $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'userId' => $userId,
                'comment' => $this->faker->text,
                'parent' => $comment[0],
            ]
        );

        $this->classBeingTested->delete($comment[0]->getId());

        $this->assertDatabaseHas(
            ConfigService::$tableComments,
            [
                'id' => $comment[0]->getId(),
                'deleted_at' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableComments,
            [
                'id' => $reply[0]->getId(),
                'deleted_at' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
    }

    public function test_delete_comment()
    {
        $userId = $this->createAndLogInNewUser();

        CommentRepository::$softDelete = false;

        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ]
        );

        $comment = $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'userId' => $userId,
                'comment' => $this->faker->text,
            ]
        );

        $commentId = $comment[0]->getId();

        $this->classBeingTested->delete($commentId);

        $this->assertDatabaseMissing(
            ConfigService::$tableComments,
            [
                'id' => $commentId,
            ]
        );
    }

    public function test_delete_comment_with_replies()
    {
        CommentRepository::$softDelete = false;

        $userId = $this->createAndLogInNewUser();

        CommentRepository::$softDelete = false;

        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ]
        );

        $comment = $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'userId' => $userId,
                'comment' => $this->faker->text,
            ]
        );

        $reply = $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'userId' => $userId,
                'comment' => $this->faker->text,
                'parent' => $comment[0]
            ]
        );

        $commentId = $comment[0]->getId();
        $replyId = $reply[0]->getId();

        $this->classBeingTested->delete($commentId);

        $this->assertDatabaseMissing(
            ConfigService::$tableComments,
            [
                'id' => $commentId,
            ]
        );

        $this->assertDatabaseMissing(
            ConfigService::$tableComments,
            [
                'id' => $replyId,
            ]
        );
    }
}
