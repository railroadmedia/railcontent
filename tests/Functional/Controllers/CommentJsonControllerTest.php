<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentJsonControllerTest extends RailcontentTestCase
{
    use ArraySubsetAsserts;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var CommentFactory
     */
    protected $commentFactory;

    public function test_add_comment_response()
    {
        $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $response = $this->call('PUT', 'railcontent/comment', [
            'comment' => $this->faker->text(),
            'content_id' => $content['id'],
            'display_name' => $this->faker->word(),
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_add_comment_on_not_commentable_type_response()
    {
        $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->word,
            ContentService::STATUS_PUBLISHED
        );

        $response = $this->call('PUT', 'railcontent/comment', [
            'comment' => $this->faker->text(),
            'content_id' => $content['id'],
            'display_name' => $this->faker->word(),
        ]);

        $this->assertEquals(403, $response->getStatusCode());
        $response->assertJsonFragment(['The content type does not allow comments.']);
    }

    public function test_add_comment_validation_errors()
    {
        $this->createAndLogInNewUser();

        $response = $this->call('PUT', 'railcontent/comment', [
            'content_id' => rand(),
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
            'comment' => $updatedComment,
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        $expectedResults = [
            'id' => $comment['id'],
            'comment' => $updatedComment,
            'content_id' => $content['id'],
            'parent_id' => null,
            'user_id' => $userId,
            'created_on' => Carbon::now()->toDateTimeString(),
            'deleted_at' => null,
            'display_name' => $comment['display_name'],
            'replies' => [],
        ];

        $this->assertArraySubset($expectedResults, $response->decodeResponseJson()->json('data')[0]);
    }

    public function test_update_other_comment_response()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());

        $updatedComment = $this->faker->text();
        $response = $this->call('PATCH', 'railcontent/comment/' . $comment['id'], [
            'comment' => $updatedComment,
        ]);

        $this->assertEquals(403, $response->getStatusCode());

        $response->assertJsonFragment(['Update failed, you can update only your comments.']);
    }

    public function test_update_comment_validation_errors()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, $userId);

        $response = $this->call('PATCH', 'railcontent/comment/' . $comment['id'], [
            'content_id' => rand(),
            'parent_id' => rand(),
            'display_name' => '',
        ]);

        $this->assertEquals(422, $response->getStatusCode());

        $response->assertJsonFragment(['The selected content id is invalid.']);
        $response->assertJsonFragment(['The selected parent id is invalid.']);
        $response->assertJsonFragment(['The display name field must have a value.']);
    }

    public function test_update_inexistent_comment_response()
    {
        $userId = $this->createAndLogInNewUser();
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
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());

        CommentService::$canManageOtherComments = true;
        $updatedComment = $this->faker->text();
        $response = $this->call('PATCH', 'railcontent/comment/' . $comment['id'], [
            'comment' => $updatedComment,
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        $expectedResults = [
            'id' => $comment['id'],
            'comment' => $updatedComment,
            'content_id' => $content['id'],
            'parent_id' => null,
        ];
        $this->assertArraySubset($expectedResults, $response->decodeResponseJson()->json('data')[0]);
    }

    public function test_delete_my_comment_response()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
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
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $comment =
            $this->commentFactory->create($this->faker->text, $content['id'], null, $this->faker->randomNumber());
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
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());

        CommentService::$canManageOtherComments = true;
        $response = $this->call('DELETE', 'railcontent/comment/' . $comment['id'], ['auth_level' => 'administrator']);

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function test_reply_to_a_comment()
    {
        $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());

        $response = $this->call('PUT', 'railcontent/comment/reply', [
            'comment' => $this->faker->text(),
            'parent_id' => $comment['id'],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_reply_to_a_comment_validation_errors()
    {
        $this->createAndLogInNewUser();
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
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

        $this->assertEquals([], $response->decodeResponseJson()->json('data'));
    }

    public function test_pull_comments_paginated()
    {
        $page = 2;
        $limit = 10;
        $totalNumber = $this->faker->numberBetween($limit, ($limit + 25));

        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        for ($i = 1; $i <= $totalNumber; $i++) {
            $comments[$i] =
                $this->commentFactory->create($this->faker->text, $content['id'], null, rand())->getArrayCopy();
            $comments[$i]['replies'] = [];
        }

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => $page,
                'limit' => $limit,
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(
            array_slice($comments, ($limit * ($page - 1)), $limit, false),
            $response->decodeResponseJson()->json('data')
        );
    }

    public function test_pull_content_comments_paginated()
    {
        $page = 2;
        $limit = 3;
        $totalNumber = $this->faker->numberBetween($limit, ($limit + 25));

        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $otherContent = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes)
        );

        for ($i = 1; $i <= $totalNumber; $i++) {
            $comments[$i] =
                $this->commentFactory->create($this->faker->text, $content['id'], null, rand())->getArrayCopy();
            $comments[$i]['replies'] = [];
        }

        for ($i = 1; $i <= $totalNumber; $i++) {
            $otherContentcomments[$i] =
                $this->commentFactory->create($this->faker->text, $otherContent['id'], null, rand());
        }

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => $page,
                'limit' => $limit,
                'content_id' => $content['id'],
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(
            array_slice($comments, ($limit * ($page - 1)), $limit, false),
            $response->decodeResponseJson()->json('data')
        );
    }

    public function test_pull_user_comments_paginated()
    {
        $page = 2;
        $limit = 3;
        $totalNumber = $this->faker->numberBetween($limit, ($limit + 25));
        $userId = 1;

        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        for ($i = 1; $i <= $totalNumber; $i++) {
            $comments[$i] =
                $this->commentFactory->create($this->faker->text, $content['id'], null, $userId)->getArrayCopy();
            $comments[$i]['replies'] = [];
        }

        for ($i = 1; $i <= 5; $i++) {
            $otherUsercomments[$i] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        }

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => $page,
                'limit' => $limit,
                'user_id' => $userId,
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(
            array_slice($comments, ($limit * ($page - 1)), $limit, false),
            $response->decodeResponseJson()->json('data')
        );
    }

    public function test_pull_comments_ordered_by_like_count()
    {
        // create content
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        // create content comments
        $comments = [];

        $comments[] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        $comments[] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        $comments[] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        $comments[] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        $comments[] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());

        // select two comment ids
        $firstOrderedCommentId = $comments[2]['id'];
        $secondOrderedCommentId = $comments[4]['id'];

        // add a known number of likes to selected comments
        $commentThreeLikeOne = [
            'comment_id' => $firstOrderedCommentId,
            'user_id' => $this->faker->randomNumber(),
            'created_on' => Carbon::instance($this->faker->dateTime)->toDateTimeString(),
        ];

        $this->databaseManager
            ->table(ConfigService::$tableCommentLikes)
            ->insertGetId($commentThreeLikeOne);

        $commentThreeLikeTwo = [
            'comment_id' => $firstOrderedCommentId,
            'user_id' => $this->faker->randomNumber(),
            'created_on' => Carbon::instance($this->faker->dateTime)->toDateTimeString(),
        ];

        $this->databaseManager
            ->table(ConfigService::$tableCommentLikes)
            ->insertGetId($commentThreeLikeTwo);

        $commentFourLike = [
            'comment_id' => $secondOrderedCommentId,
            'user_id' => $this->faker->randomNumber(),
            'created_on' => Carbon::instance($this->faker->dateTime)->toDateTimeString(),
        ];

        $this->databaseManager
            ->table(ConfigService::$tableCommentLikes)
            ->insertGetId($commentFourLike);

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => 1,
                'limit' => 25,
                'content_id' => $content['id'],
                'sort' => '-like_count',
            ]
        );

        $decodedResponse = $response->decodeResponseJson();

        // assert the order of results
        $this->assertEquals($decodedResponse['data'][0]['id'], $firstOrderedCommentId);
        $this->assertEquals($decodedResponse['data'][1]['id'], $secondOrderedCommentId);
    }

    public function test_pull_comments_filtered_by_my_comments()
    {
        // create content
        $content = $this->contentFactory->create(
            $this->faker->word,
            $this->faker->randomElement(ConfigService::$commentableContentTypes),
            ContentService::STATUS_PUBLISHED
        );

        $currentUserId = $this->createAndLogInNewUser();

        // create content comments

        // 1st comment, no parent, should be returned
        $firstComment = $this->commentFactory->create($this->faker->text, $content['id'], null, $currentUserId);

        // 2nd comment, parent is 1st comment, should be returned as nested
        $secondComment =
            $this->commentFactory->create($this->faker->text, $content['id'], $firstComment['id'], rand(5, 50));

        // 3rd comment, no parent, should not be returned
        $thirdComment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand(5, 50));

        // 4th comment, parent is 3rd comment, should not be returned
        $this->commentFactory->create($this->faker->text, $content['id'], $thirdComment['id'], rand(5, 50));

        // 5th comment, no parent, should not be returned
        $this->commentFactory->create($this->faker->text, $content['id'], null, rand(5, 50));

        // 6th comment, no parent, should be returned
        $sixthComment = $this->commentFactory->create($this->faker->text, $content['id'], null, $currentUserId);

        // 7th comment, parent is 6th comment, should be returned as nested
        $seventhComment =
            $this->commentFactory->create($this->faker->text, $content['id'], $sixthComment['id'], $currentUserId);

        // 8th comment, parent is 6th comment, should be returned as nested
        $eighthComment =
            $this->commentFactory->create($this->faker->text, $content['id'], $sixthComment['id'], rand(5, 50));

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => 1,
                'limit' => 25,
                'content_id' => $content['id'],
                'sort' => '-mine',
            ]
        );

        $decodedResponse = $response->decodeResponseJson();

        // assert results count
        $this->assertEquals($decodedResponse['meta']['totalResults'], 3);

        // assert results
        $this->assertEquals($decodedResponse['data'][0]['id'], $firstComment['id']);
        $this->assertEquals($decodedResponse['data'][0]['replies'][0]['id'], $secondComment['id']);
        $this->assertEquals($decodedResponse['data'][1]['id'], $sixthComment['id']);
        $this->assertEquals($decodedResponse['data'][1]['replies'][0]['id'], $seventhComment['id']);
        $this->assertEquals($decodedResponse['data'][1]['replies'][1]['id'], $eighthComment['id']);
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
            $comments[$i] =
                $this->commentFactory->create($this->faker->text, $content['id'], null, rand())->getArrayCopy();
            $comments[$i]['replies'] = [];
        }

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => $page,
                'limit' => $limit,
                'content_type' => $content['type'],
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $expectedResults = $this->createPaginatedExpectedResult(
            'ok',
            200,
            $page,
            $limit,
            $totalNumber,
            array_slice($comments, ($limit * ($page - 1)), $limit, false),
            null
        );

        $this->assertEquals(
            array_slice($comments, ($limit * ($page - 1)), $limit, false),
            $response->decodeResponseJson()->json('data')
        );
    }

    public function test_pull_comments_filtered_by_brand()
    {
        $page = 1;
        $limit = 3;
        $totalNumber = $this->faker->numberBetween($limit, ($limit + 25));
        $otherBrand = $this->faker->word;
        $brands = ConfigService::$availableBrands;

        ConfigService::$availableBrands[] = $otherBrand;

        $content = $this->contentFactory->create(
            $this->faker->word,
            ConfigService::$commentableContentTypes[0]
        );

        $contentForOtherBrand = $this->contentFactory->create(
            $this->faker->word,
            ConfigService::$commentableContentTypes[0],
            ContentService::STATUS_PUBLISHED,
            'en-US',
            $otherBrand
        );

        for ($i = 1; $i <= $totalNumber; $i++) {
            $comments[$i] =
                $this->commentFactory->create($this->faker->text, $content['id'], null, rand())->getArrayCopy();
            $comments[$i]['replies'] = [];
        }

        for ($i = 1; $i <= $totalNumber; $i++) {
            $otherBrandComments[$i] =
                $this->commentFactory->create($this->faker->text, $contentForOtherBrand['id'], null, rand());
        }

        ConfigService::$availableBrands = $brands;

        $response = $this->call('GET', 'railcontent/comment',
            [
                'page' => $page,
                'limit' => $limit,
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(
            array_slice($comments, ($limit * ($page - 1)), $limit, false),
            $response->decodeResponseJson()->json('data')
        );
    }

    public function test_get_linked_comment()
    {
        $commentsNr = 12;
        $content = $this->contentFactory->create(
            $this->faker->word,
            ConfigService::$commentableContentTypes[0]
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand())->getArrayCopy();

        for ($i = 1; $i <= $commentsNr; $i++) {
            $comments[$i] =
                $this->commentFactory->create($this->faker->text, $content['id'], null, rand())->getArrayCopy();
        }

        $response = $this->call('GET', 'railcontent/comment/' . $comment['id']);

        $this->assertEquals([$comments[2], $comments[1], $comment], $response->decodeResponseJson()->json('data'));
        $this->assertEquals(($commentsNr + 1), $response->decodeResponseJson()->json('meta')['totalResults']);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->commentFactory = $this->app->make(CommentFactory::class);
    }
}
