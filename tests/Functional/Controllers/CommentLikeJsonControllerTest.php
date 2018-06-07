<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentLikeJsonControllerTest extends RailcontentTestCase
{
    /** @var ContentFactory */
    private $contentFactory;

    /** @var CommentFactory */
    private $commentFactory;


    private $comments;
    private $content;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->commentFactory = $this->app->make(CommentFactory::class);

        $this->comments = [];
        $this->content = [];
    }

    // ========================== helper classes ====================================

    private function createContent($amount = 1)
    {
        for ($i = 0; $i < $amount; $i++) {
            $this->content[] = $this->contentFactory->create(
                $this->faker->word,
                $this->faker->randomElement(ConfigService::$commentableContentTypes),
                ContentService::STATUS_PUBLISHED
            );
        }
    }

    private function createComments($content = null, $amount = 1, $parentId = null)
    {
        if (empty($content)) {
            if (empty($this->content[0])) {
                $this->createContent();
            }
            $content = $this->content[0];
        }

        for ($i = 0; $i < $amount; $i++) {
            $this->comments[$content['id']][] = $this->commentFactory->create(
                $this->faker->text,
                $content['id'],
                $parentId,
                rand()
            );
        }
    }

    public function like($userIdOfLiker, $assertions = false)
    {
        $this->createComments();

        $contentId = $this->content[0]['id'];
        $comment = $this->comments[$contentId][0];

        $commentId = $comment['id'];

        $response = $this->call(
            'PUT',
            'railcontent/comment-like',
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
            'railcontent/comment-like',
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
