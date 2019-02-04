<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Faker\ORM\Doctrine\Populator;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentLikeJsonControllerTest extends RailcontentTestCase
{
    /**
     * @var Populator
     */
    private $populator;

    protected function setUp()
    {
        parent::setUp();

        $this->populator = new Populator($this->faker, $this->entityManager);
    }

    public function fakeComment($nr = 1, $commentData = [])
    {
        $this->populator->addEntity(
            Content::class,
            1,
            [
                'slug' => 'slug1',
                'status' => 'published',
                'type' => 'course',
                'brand' => ConfigService::$brand,
            ]
        );
        $this->populator->execute();

        if (empty($commentData)) {
            $commentData = [
                'userId' => 1,
                'content' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
            ];
        }
        $this->populator->addEntity(
            Comment::class,
            $nr,
            $commentData

        );
        $fakePopulator = $this->populator->execute();

        return $fakePopulator[Comment::class];
    }

    public function like($userIdOfLiker, $assertions = false)
    {
        $comments = $this->fakeComment();

        $contentId = 1;
        $comment = $comments[0];

        $commentId = $comment->getId();

        $response = $this->call(
            'PUT',
            'railcontent/comment-like/'.$commentId,
            [
                'comment_id' => $commentId,
                'user_id' => $userIdOfLiker,
            ]
        );

        if($assertions) {
            $this->assertEquals(200, $response->getStatusCode());

            $this->assertDatabaseHas(
                ConfigService::$tableCommentLikes,
                [
                    'comment_id' => $commentId,
                    'user_id' => $userIdOfLiker,
                ]
            );
        }

        return $commentId;
    }

    // ============================ test cases ======================================

    public function test_user_likes_comment()
    {
        $userIdOfLiker = $this->createAndLogInNewUser();

        $this->like($userIdOfLiker, true);
    }

    public function test_user_unlikes_comment()
    {
        $userIdOfLiker = $this->createAndLogInNewUser();

        $commentId = $this->like($userIdOfLiker);

        $response = $this->call(
            'DELETE',
            'railcontent/comment-like/'.$commentId,
            [
                'comment_id' => $commentId,
                'user_id' => $userIdOfLiker,
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertDatabaseMissing(
            ConfigService::$tableCommentLikes,
            [
                'comment_id' => $commentId,
                'user_id' => $userIdOfLiker,
            ]
        );
    }
}
