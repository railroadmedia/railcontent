<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Faker\ORM\Doctrine\Populator;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\CommentAssignment;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentAssignationJsonControllerTest extends RailcontentTestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function test_pull_my_assigned_comments_when_not_exists()
    {
        $this->createAndLogInNewUser();
        $response = $this->call('GET', 'railcontent/assigned-comments');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals([], $response->decodeResponseJson('data'));
    }

    public function test_pull_my_assigned_comments()
    {
        $userId = $this->faker->randomElement(ConfigService::$commentsAssignationOwnerIds);

        $comment = $this->fakeComment(5);
        for ($i = 0; $i < 5; $i++) {
            $this->populator->addEntity(
                CommentAssignment::class,
                1,
                [
                    'comment' => $comment[$i],
                    'userId' => $userId,
                ]
            );
            $this->populator->execute();
        }


        $response = $this->call('GET', 'railcontent/assigned-comments', ['user_id' => $userId]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(5, count($response->decodeResponseJson('data')));

        foreach ($response->decodeResponseJson('data') as $response)
        {
            $this->assertEquals($userId, $response['attributes']['user_id']);
        }
    }

    public function test_delete_assigned_comment()
    {
        $this->fakeContent();

        $comment = $this->fakeComment();

        $this->populator->addEntity(
            CommentAssignment::class,
            3,
            [
                'comment' => $comment[0],
                'userId' => rand(2, 10),
            ]

        );
        $this->populator->execute();

        $response = $this->call('DELETE', 'railcontent/assigned-comment/' . $comment[0]->getId());

        $this->assertEquals(204, $response->getStatusCode());

        $this->assertDatabaseMissing(
            ConfigService::$tableCommentsAssignment,
            [
                'comment_id' => $comment[0]->getId(),
            ]
        );
    }
}
