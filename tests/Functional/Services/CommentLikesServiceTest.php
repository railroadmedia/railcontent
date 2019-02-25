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

    public function fakeCommentLike($nr = 1, $commentLikeData = [])
    {
        if (empty($commentLikeData)) {
            $commentLikeData = [
                'userId' => 1,
                'comment' => $this->fakeComment(),
            ];
        }
        $this->populator->addEntity(
            CommentLikes::class,
            $nr,
            $commentLikeData

        );
        $fakePopulator = $this->populator->execute();

        return $fakePopulator[CommentLikes::class];
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

}
