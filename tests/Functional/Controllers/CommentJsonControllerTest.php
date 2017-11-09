<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;


use Carbon\Carbon;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentJsonControllerTest extends RailcontentTestCase
{
    protected $contentFactory;

    protected $commentFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->commentFactory = $this->app->make(CommentFactory::class);
    }

    public function test_add_comment()
    {
        $this->createAndLogInNewUser();
        $content = $this->contentFactory->create();

        $response = $this->call('PUT', 'railcontent/comment', [
            'comment' => $this->faker->text(),
            'content_id' => $content['id']
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_edit_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create();
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, $userId);

        $updatedComment = $this->faker->text();
        $response = $this->call('PATCH', 'railcontent/comment/' . $comment['id'], [
            'comment' => $updatedComment
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        $expectedResults = $this->createExpectedResult('ok', 201, [
            'id' => $comment['id'],
            'comment' => $updatedComment,
            'content_id' => $content['id'],
            'parent_id' => null,
            'user_id' => $userId,
            'created_on' => Carbon::now()->toDateTimeString(),
            'deleted_at' => null
        ]);

        $this->assertEquals($expectedResults, $response->decodeResponseJson());
    }
}
