<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Faker\ORM\Doctrine\Populator;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Factories\CommentFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\Hydrators\CommentFakeDataHydrator;
use Railroad\Railcontent\Tests\RailcontentTestCase;
use Railroad\Railcontent\Transformers\CommentTransformer;

class CommentJsonControllerTest extends RailcontentTestCase
{
    private $populator;

    protected function setUp()
    {
        parent::setUp();

        $this->fakeDataHydrator = new CommentFakeDataHydrator($this->entityManager);

        $this->populator = new Populator($this->faker, $this->entityManager);
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

        $this->populator->addEntity(
            Content::class,
            1,
            [
                'slug' => 'slug1',
                'status' => 'published',
                'type' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );
        $this->populator->execute();

        $this->populator->addEntity(
            Comment::class,
            1,
            [
                'userId' => 1,
                'content' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
            ]
        );
        $this->populator->execute();

        $this->populator->addEntity(
            Comment::class,
            1,
            ['userId' => rand(2, 10)]
        );
        $this->populator->execute();
    }

    public function test_add_comment_response()
    {
        $userId = $this->createAndLogInNewUser();

        $attributes = $this->fakeDataHydrator->getAttributeArray(Comment::class, new CommentTransformer());

        $attributes['user_id'] = $userId;

        unset($attributes['id']);
        unset($attributes['created_on']);
        unset($attributes['deleted_at']);

        $response = $this->call(
            'PUT',
            'railcontent/comment',
            [
                'data' => [
                    'attributes' => $attributes,
                    'relationships' => [
                        'content' => [
                            'type' => 'content',
                            'id' => 1,
                        ],
                    ],
                ],
            ]
        );

        $expectedResults = [
            'type' => 'comment',
            'id' => 3,
            'attributes' => $attributes,
        ];

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset($expectedResults, $response->decodeResponseJson('data'));

    }

    public function test_add_comment_on_not_commentable_type_response()
    {
        $this->createAndLogInNewUser();

        $response = $this->call(
            'PUT',
            'railcontent/comment',
            [
                'data' => [
                    'attributes' => [
                        'comment' => $this->faker->text(),
                    ],
                    'relationships' => [
                        'content' => [
                            'type' => 'content',
                            'id' => 2,
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(403, $response->getStatusCode());
        $response->assertJsonFragment(['The content type does not allow comments.']);
    }

    public function test_add_comment_validation_errors()
    {
        $this->createAndLogInNewUser();

        $response = $this->call(
            'PUT',
            'railcontent/comment',
            [
                'data' => [
                    'relationships' => [
                        'content' => [
                            'type' => 'content',
                            'id' => rand(),
                        ],
                    ],
                ],
            ]
        );

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

        $updatedComment = $this->faker->text();
        $response = $this->call(
            'PATCH',
            'railcontent/comment/' . 1,
            [
                'data' => [
                    'type' => 'comment',
                    'attributes' => [
                        'comment' => $updatedComment,
                    ],
                ],
            ]
        );

        $this->assertEquals(201, $response->getStatusCode());

        $expectedResults = [
            'comment' => $updatedComment,
            'user_id' => $userId,

        ];

        $this->assertArraySubset($expectedResults, $response->decodeResponseJson('data')['attributes']);
    }

    public function test_update_other_comment_response()
    {
        $userId = $this->createAndLogInNewUser();

        $updatedComment = $this->faker->text();
        $response = $this->call(
            'PATCH',
            'railcontent/comment/' . 2,
            [
                'data' => [
                    'type' => 'comment',
                    'attributes' => [
                        'comment' => $updatedComment,
                    ],
                ],
            ]
        );

        $this->assertEquals(403, $response->getStatusCode());

        $response->assertJsonFragment(['Update failed, you can update only your comments.']);
    }

    public function test_update_comment_validation_errors()
    {
        $userId = $this->createAndLogInNewUser();

        $response = $this->call(
            'PATCH',
            'railcontent/comment/' . 1,
            [
                'data' => [
                    'attributes' => [
                        'display_name' => '',
                    ],
                    'relationships' => [
                        'content' => [
                            'type' => 'content',
                            'id' => rand(30, 100),
                        ],
                        'parent' => [
                            'type' => 'comment',
                            'id' => rand(3, 10),
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(422, $response->getStatusCode());

        $response->assertJsonFragment(['The selected content is invalid.']);
        $response->assertJsonFragment(['The selected parent is invalid.']);
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

        CommentService::$canManageOtherComments = true;
        $updatedComment = $this->faker->text();
        $response = $this->call(
            'PATCH',
            'railcontent/comment/' . 2,
            [
                'data' => [
                    'type' => 'comment',
                    'attributes' => [
                        'comment' => $updatedComment,
                    ],
                ],
            ]
        );

        $this->assertEquals(201, $response->getStatusCode());

        $expectedResults = [
            'comment' => $updatedComment,
        ];

        $this->assertArraySubset($expectedResults, $response->decodeResponseJson('data')['attributes']);
    }

    public function test_delete_my_comment_response()
    {
        $userId = $this->createAndLogInNewUser();

        $response = $this->call('DELETE', 'railcontent/comment/' . 1);

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function test_user_can_not_delete_others_comment()
    {
        $userId = $this->createAndLogInNewUser();

        CommentService::$canManageOtherComments = false;

        $response = $this->call('DELETE', 'railcontent/comment/' . 2);

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

        CommentService::$canManageOtherComments = true;

        $response = $this->call('DELETE', 'railcontent/comment/' . 2);

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function test_reply_to_a_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $reply = $this->faker->paragraph;
        $response = $this->call(
            'PUT',
            'railcontent/comment/reply',
            [
                'data' => [
                    'attributes' => [
                        'comment' => $reply,
                    ],
                    'relationships' => [
                        'parent' => [
                            'type' => 'comment',
                            'id' => 1,
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $expectedResults = [
            'data' => [
                'type' => 'comment',
                'attributes' => [
                    'comment' => $reply,
                    'user_id' => $userId,
                ],
            ],
        ];

        $this->assertArraySubset($expectedResults, $response->decodeResponseJson());

    }

    public function test_reply_to_a_comment_validation_errors()
    {
        $this->createAndLogInNewUser();

        $response = $this->call('PUT', 'railcontent/comment/reply');

        $this->assertEquals(422, $response->getStatusCode());
        $response->assertJsonFragment(['The comment field is required.']);
        $response->assertJsonFragment(['The parent field is required.']);
    }

    public function _test_pull_comments_when_not_exists()
    {
        $response = $this->call('GET', 'railcontent/comment');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals([], $response->decodeResponseJson('data'));
    }

    public function test_pull_comments_paginated()
    {
        $limit = 10;
        $totalNumber = $this->faker->numberBetween($limit, ($limit + 25));

        $this->populator->addEntity(Comment::class, $totalNumber);

        $this->populator->execute();


        $request = [
            'limit' => $limit,
            'sort' => '-createdOn',
        ];
        $response = $this->call(
            'GET',
            'railcontent/comment',
            $request + ['page' => 1]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $data = $response->decodeResponseJson()['data'];

        $this->assertEquals($request['limit'], count($data));
    }

    public function _test_pull_content_comments_paginated()
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
            $comments[$i] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
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
            $response->decodeResponseJson('data')
        );
    }

    public function _test_pull_user_comments_paginated()
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
            $comments[$i] = $this->commentFactory->create($this->faker->text, $content['id'], null, $userId);
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
            $response->decodeResponseJson('data')
        );
    }

    public function _test_pull_comments_ordered_by_like_count()
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
            'created_on' => Carbon::instance($this->faker->dateTime)
                ->toDateTimeString(),
        ];

        $this->databaseManager->table(ConfigService::$tableCommentLikes)
            ->insertGetId($commentThreeLikeOne);

        $commentThreeLikeTwo = [
            'comment_id' => $firstOrderedCommentId,
            'user_id' => $this->faker->randomNumber(),
            'created_on' => Carbon::instance($this->faker->dateTime)
                ->toDateTimeString(),
        ];

        $this->databaseManager->table(ConfigService::$tableCommentLikes)
            ->insertGetId($commentThreeLikeTwo);

        $commentFourLike = [
            'comment_id' => $secondOrderedCommentId,
            'user_id' => $this->faker->randomNumber(),
            'created_on' => Carbon::instance($this->faker->dateTime)
                ->toDateTimeString(),
        ];

        $this->databaseManager->table(ConfigService::$tableCommentLikes)
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

    public function _test_pull_comments_filtered_by_my_comments()
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
        $sixthComment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand(5, 50));

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
        $this->assertEquals($decodedResponse['meta']['totalResults'], 2);

        // assert results
        $this->assertEquals($decodedResponse['data'][0]['id'], $firstComment['id']);
        $this->assertEquals($decodedResponse['data'][0]['replies'][0]['id'], $secondComment['id']);
        $this->assertEquals($decodedResponse['data'][1]['id'], $sixthComment['id']);
        $this->assertEquals($decodedResponse['data'][1]['replies'][0]['id'], $seventhComment['id']);
        $this->assertEquals($decodedResponse['data'][1]['replies'][1]['id'], $eighthComment['id']);
    }

    public function _test_pull_comments_filtered_by_content_type()
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
            $response->decodeResponseJson('data')
        );
    }

    public function _test_pull_comments_filtered_by_brand()
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
            $comments[$i] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
            $comments[$i]['replies'] = [];
        }

        for ($i = 1; $i <= $totalNumber; $i++) {
            $otherBrandComments[$i] =
                $this->commentFactory->create($this->faker->text, $contentForOtherBrand['id'], null, rand());
        }

        ConfigService::$availableBrands = $brands;

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
            $response->decodeResponseJson('data')
        );
    }

    public function _test_get_linked_comment()
    {
        $commentsNr = 12;
        $content = $this->contentFactory->create(
            $this->faker->word,
            ConfigService::$commentableContentTypes[0]
        );
        $comment = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());

        for ($i = 1; $i <= $commentsNr; $i++) {
            $comments[$i] = $this->commentFactory->create($this->faker->text, $content['id'], null, rand());
        }

        $response = $this->call('GET', 'railcontent/comment/' . $comment['id']);

        $this->assertEquals([$comments[2], $comments[1], $comment], $response->decodeResponseJson('data'));
        $this->assertEquals(($commentsNr + 1), $response->decodeResponseJson('meta')['totalResults']);
    }
}
