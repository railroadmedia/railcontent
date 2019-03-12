<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Faker\ORM\Doctrine\Populator;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentLikeJsonControllerTest extends RailcontentTestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function like($userIdOfLiker, $assertions = false)
    {
        $comments = $this->fakeComment();
        $comment = $comments[0];
        $commentId = $comment->getId();

        $response = $this->call(
            'PUT',
            'railcontent/comment-like/' . $commentId,
            [
                'comment_id' => $commentId,
                'user_id' => $userIdOfLiker,
            ]
        );

        if ($assertions) {
            $this->assertEquals(200, $response->getStatusCode());

            $this->assertDatabaseHas(
                config('railcontent.table_prefix'). 'comment_likes',
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
            'railcontent/comment-like/' . $commentId,
            [
                'comment_id' => $commentId,
                'user_id' => $userIdOfLiker,
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix'). 'comment_likes',
            [
                'comment_id' => $commentId,
                'user_id' => $userIdOfLiker,
            ]
        );
    }
}
