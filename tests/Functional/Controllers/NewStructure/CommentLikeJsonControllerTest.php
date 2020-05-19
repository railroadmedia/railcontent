<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers\NewStructure;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentLikeJsonControllerTest extends RailcontentTestCase
{
    protected function setUp()
    {
        parent::setUp();
        ResponseService::$oldResponseStructure = false;
    }

    public function like($userIdOfLiker, $assertions = false)
    {
        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
                'status' => $this->faker->randomElement(ContentRepository::$availableContentStatues),
                'brand' => config('railcontent.brand'),
            ]
        );
        $comments = $this->fakeComment(
            1,
            [
                'content' => $content[0],
                'deletedAt' => null,
            ]
        );

        $comment = $comments[0];
        $commentId = $comment->getId();

        $response = $this->call(
            'PUT',
            'railcontent/comment-like/' . $commentId,
            [
                'user_id' => $userIdOfLiker,
            ]
        );

        if ($assertions) {
            $this->assertEquals(200, $response->getStatusCode());

            $this->assertDatabaseHas(
                config('railcontent.table_prefix') . 'comment_likes',
                [
                    'comment_id' => $commentId,
                    'user_id' => $userIdOfLiker,
                ]
            );
        }

        $commentRequestResponse = $this->call(
            'GET',
            'railcontent/comment/' . $commentId
        );

        $this->assertEquals(1, $commentRequestResponse->decodeResponseJson('data')[0]['attributes']['like_count']);
        $this->assertEquals(
            1,
            count($commentRequestResponse->decodeResponseJson('data')[0]['attributes']['like_users'])
        );
        $this->assertTrue($commentRequestResponse->decodeResponseJson('data')[0]['attributes']['is_liked']);
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
        $comments = $this->fakeComment();

        $commentLike = $this->fakeCommentLike(
            1,
            [
                'comment' => $comments[0],
                'userId' => $userIdOfLiker,
            ]
        );

        $response = $this->call(
            'DELETE',
            'railcontent/comment-like/' . $comments[0]->getId(),
            [
                'comment_id' => $comments[0]->getId(),
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'comment_likes',
            [
                'comment_id' => $comments[0]->getId(),
                'user_id' => $userIdOfLiker,
            ]
        );
    }
}
