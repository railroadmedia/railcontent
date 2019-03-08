<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Faker\ORM\Doctrine\Populator;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\CommentLikes;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Services\CommentLikeService;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentLikesServiceTest extends RailcontentTestCase
{
    /**
     * @var CommentService
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(CommentLikeService::class);
    }

    public function test_get_by_comment_ids()
    {
        $comments = $this->fakeComment(2);
        $this->fakeCommentLike(
            5,
            [
                'comment' => $comments[0],
                'userId' => rand(),
            ]
        );

        $this->fakeCommentLike(
            2,
            [
                'comment' => $comments[1],
                'userId' => rand(),
            ]
        );
        $results = $this->classBeingTested->getByCommentIds(
            [1, 2]
        );

        $this->assertEquals(7, count($results));

        foreach ($results as $result) {
            $this->assertTrue(
                in_array(
                    $result->getComment()
                        ->getId(),
                    [1, 2]
                )
            );
        }

        $results = $this->classBeingTested->countForCommentIds(
            [1, 2]
        );

        $this->assertEquals(5, $results[$comments[0]->getId()]);

        $this->assertEquals(2, $results[$comments[1]->getId()]);
    }

    public function test_like_comment()
    {
        $userId = $this->createAndLogInNewUser();

        $comment = $this->fakeComment();

        $results = $this->classBeingTested->create($comment[0]->getId(), $userId);

        $this->assertEquals($comment[0], $results->getComment());
        $this->assertEquals($userId, $results->getUser()->getId());

        $this->assertDatabaseHas(
            config('railcontent.table_prefix') . 'comment_likes',
            [
                'comment_id' => $comment[0]->getId(),
                'user_id' => $userId,
            ]
        );
    }

    public function test_delete_comment_like()
    {
        $userId = $this->createAndLogInNewUser();

        $comment = $this->fakeComment();
        $this->fakeCommentLike(
            1,
            [
                'comment' => $comment[0],
                'userId' => $userId,
            ]
        );

        $results = $this->classBeingTested->delete($comment[0]->getId(), $userId);

        $this->assertTrue($results);

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'comment_likes',
            [
                'comment_id' => $comment[0]->getId(),
                'user_id' => $userId,
            ]
        );
    }

    public function test_count_likes()
    {
        $comments = $this->fakeComment(2);

        $this->fakeCommentLike(
            5,
            [
                'comment' => $comments[0],
                'userId' => rand(1, 100),
            ]
        );

        $this->fakeCommentLike(
            12,
            [
                'comment' => $comments[1],
                'userId' => rand(100, 150),
            ]
        );

        $result = $this->classBeingTested->countForCommentIds([$comments[0]->getId(), $comments[1]->getId()]);

        $this->assertEquals(
            [
                $comments[0]->getId() => 5,
                $comments[1]->getId() => 12,
            ],
            $result
        );
    }
}
