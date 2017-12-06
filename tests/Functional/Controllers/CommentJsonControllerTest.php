<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;


use Carbon\Carbon;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentJsonControllerTest extends RailcontentTestCase
{
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

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->commentFactory = $this->app->make(CommentFactory::class);
    }

    public function test_add_comment_response()
    {
        $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );

        $response = $this->call('PUT', 'railcontent/comment', [
            'comment' => $this->faker->text(),
            'content_id' => $content['id'],
            'display_name' => $this->faker->word()
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_add_comment_on_not_commentable_type_response()
    {
        $this->createAndLogInNewUser();
        $content = $this->contentFactory->create();

        $response = $this->call('PUT', 'railcontent/comment', [
            'comment' => $this->faker->text(),
            'content_id' => $content['id'],
            'display_name' => $this->faker->word()
        ]);

        $this->assertEquals(403, $response->getStatusCode());
        $response->assertJsonFragment(['The content type does not allow comments.']);
    }

    public function test_add_comment_validation_errors()
    {
        $this->createAndLogInNewUser();

        $response = $this->call('PUT', 'railcontent/comment', [
            'content_id' => rand()
        ]);

        $this->assertEquals(422, $response->getStatusCode());
        $response->assertJsonFragment(
            ['The comment field is required.'],
            ['The selected content id is invalid.'],
            ['The display name field is required.']
        );
    }

    public function test_update_my_comment_response()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
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
            'deleted_at' => null,
            'display_name' => $comment['display_name'],
            'replies' => []
        ]);

        $this->assertEquals($expectedResults, $response->decodeResponseJson());
    }

    public function test_update_other_comment_response()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());

        $updatedComment = $this->faker->text();
        $response = $this->call('PATCH', 'railcontent/comment/' . $comment['id'], [
            'comment' => $updatedComment
        ]);

        $this->assertEquals(403, $response->getStatusCode());

        $response->assertJsonFragment(['Update failed, you can update only your comments.']);
    }

    public function test_update_comment_validation_errors()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, $userId);

        $response = $this->call('PATCH', 'railcontent/comment/' . $comment['id'], [
            'content_id' => rand(),
            'parent_id' => rand(),
            'display_name' => ''
        ]);

        $this->assertEquals(422, $response->getStatusCode());

        $response->assertJsonFragment(['The selected content id is invalid.']);
        $response->assertJsonFragment(['The selected parent id is invalid.']);
        $response->assertJsonFragment(['The display name field must have a value.']);
    }

    public function test_update_inexistent_comment_response()
    {
        $randomId = rand();
        $response = $this->call('PATCH', 'railcontent/comment/' . $randomId);

        $this->assertEquals(404, $response->getStatusCode());

        $response->assertJsonFragment(['Update failed, comment not found with id: ' . $randomId]);
    }

    public function test_admin_can_update_other_comment_response()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());

        CommentService::$canManageOtherComments = true;
        $updatedComment = $this->faker->text();
        $response = $this->call('PATCH', 'railcontent/comment/' . $comment['id'], [
            'comment' => $updatedComment
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        $expectedResults = $this->createExpectedResult('ok', 201, [
            'id' => $comment['id'],
            'comment' => $updatedComment,
            'content_id' => $content['id'],
            'parent_id' => null
        ]);

        $response->assertJson($expectedResults);
    }

    public function test_delete_my_comment_response()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, $userId);
        $response = $this->call('DELETE', 'railcontent/comment/' . $comment['id']);

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function test_user_can_not_delete_others_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, $this->faker->randomNumber());
        CommentService::$canManageOtherComments = false;

        $response = $this->call('DELETE', 'railcontent/comment/' . $comment['id']);

        $this->assertEquals(403, $response->getStatusCode());
        $response->assertJsonFragment(['Delete failed, you can delete only your comments.']);
    }

    public function test_delete_inexistent_comment_response()
    {
        $randomId = rand();
        $response = $this->call('DELETE', 'railcontent/comment/' . $randomId);

        $this->assertEquals(404, $response->getStatusCode());

        $response->assertJsonFragment(['Delete failed, comment not found with id: ' . $randomId]);
    }

    public function test_admin_can_delete_other_comment_response()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());

        CommentService::$canManageOtherComments = true;
        $response = $this->call('DELETE', 'railcontent/comment/' . $comment['id']);

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function test_reply_to_a_comment()
    {
        $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());

        $response = $this->call('PUT', 'railcontent/comment/reply', [
            'comment' => $this->faker->text(),
            'parent_id' => $comment['id']
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_reply_to_a_comment_validation_errors()
    {
        $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());

        $response = $this->call('PUT', 'railcontent/comment/reply');

        $this->assertEquals(422, $response->getStatusCode());
        $response->assertJsonFragment(['The comment field is required.']);
        $response->assertJsonFragment(['The parent id field is required.']);
    }

    public function test_pull_comments_when_not_exists()
    {
        $response = $this->call('GET', 'railcontent/comment');

        $this->assertEquals(200, $response->getStatusCode());

        $expectedResults = $this->createPaginatedExpectedResult('ok', 200, 1, 10, 0, [], null);
        $this->assertEquals($expectedResults, $response->decodeResponseJson());
    }

    public function test_pull_comments_paginated()
    {
        $page = 2;
        $limit = 10;
        $totalNumber = $this->faker->numberBetween($limit, ($limit + 25));

        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );

        for ($i = 1; $i <= $totalNumber; $i++) {
            $comments[$i] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
            $comments[$i]['replies'] = [];
        }

        $response = $this->call('GET', 'railcontent/comment',
            [
                'page' => $page,
                'limit' => $limit
            ]);

        $this->assertEquals(200, $response->getStatusCode());

        $expectedResults = $this->createPaginatedExpectedResult(
            'ok',
            200,
            $page,
            $limit,
            $totalNumber,
            array_slice($comments, ($limit * ($page - 1)), $limit, false),
            null);

        $this->assertEquals($expectedResults, $response->decodeResponseJson());
    }

    public function test_pull_content_comments_paginated()
    {
        $page = 2;
        $limit = 3;
        $totalNumber = $this->faker->numberBetween($limit, ($limit + 25));

        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );

        $otherContent = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );

        for ($i = 1; $i <= $totalNumber; $i++) {
            $comments[$i] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
            $comments[$i]['replies'] = [];
        }

        for ($i = 1; $i <= $totalNumber; $i++) {
            $otherContentcomments[$i] = $this->commentFactory->create($this->faker->text, $otherContent['id'], null, rand());
        }

        $response = $this->call('GET', 'railcontent/comment',
            [
                'page' => $page,
                'limit' => $limit,
                'content_id' => $content['id']
            ]);
        $this->assertEquals(200, $response->getStatusCode());

        $expectedResults = $this->createPaginatedExpectedResult(
            'ok',
            200,
            $page,
            $limit,
            $totalNumber,
            array_slice($comments, ($limit * ($page - 1)), $limit, false),
            null);

        $this->assertEquals($expectedResults, $response->decodeResponseJson());
    }

    public function test_pull_user_comments_paginated()
    {
        $page = 2;
        $limit = 3;
        $totalNumber = $this->faker->numberBetween($limit, ($limit + 25));
        $userId = 1;

        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );

        for ($i = 1; $i <= $totalNumber; $i++) {
            $comments[$i] = $this->commentFactory->create($this->faker->text, $content['id'], null, $userId);
            $comments[$i]['replies'] = [];
        }

        for ($i = 1; $i <= 5; $i++) {
            $otherUsercomments[$i] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        }

        $response = $this->call('GET', 'railcontent/comment',
            [
                'page' => $page,
                'limit' => $limit,
                'user_id' => $userId
            ]);
        $this->assertEquals(200, $response->getStatusCode());

        $expectedResults = $this->createPaginatedExpectedResult(
            'ok',
            200,
            $page,
            $limit,
            $totalNumber,
            array_slice($comments, ($limit * ($page - 1)), $limit, false),
            null);

        $this->assertEquals($expectedResults, $response->decodeResponseJson());
    }

    public function test_pull_comments_filtered_by_content_type()
    {
        $page = 2;
        $limit = 3;
        $totalNumber = $this->faker->numberBetween($limit, ($limit + 25));

        $content = $this->contentFactory->create(
            $this->faker->word,
            ConfigService::$commentableContentTypes[0]
        );

        for ($i = 1; $i <= $totalNumber; $i++) {
            $comments[$i] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
            $comments[$i]['replies'] = [];
        }

        $response = $this->call('GET', 'railcontent/comment',
            [
                'page' => $page,
                'limit' => $limit,
                'content_type' => $content['type']
            ]);
        $this->assertEquals(200, $response->getStatusCode());

        $expectedResults = $this->createPaginatedExpectedResult(
            'ok',
            200,
            $page,
            $limit,
            $totalNumber,
            array_slice($comments, ($limit * ($page - 1)), $limit, false),
            null);

        $this->assertEquals($expectedResults, $response->decodeResponseJson());
    }
}
