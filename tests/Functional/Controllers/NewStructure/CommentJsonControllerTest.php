<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers\NewStructure;

use Carbon\Carbon;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class CommentJsonControllerTest extends RailcontentTestCase
{
    protected function setUp()
    {
        parent::setUp();
        ResponseService::$oldResponseStructure = false;
    }

    public function test_add_comment_response()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
                'status' => $this->faker->randomElement(ContentRepository::$availableContentStatues),
            ]
        );

        $attributes = [
            'comment' => $this->faker->paragraph,
            'content' => $content[0],
            'temporary_display_name' => $this->faker->word,
        ];

        $attributes['user'] = $userId;

        unset($attributes['id']);
        unset($attributes['created_on']);
        unset($attributes['deleted_at']);

        $response = $this->call(
            'PUT',
            'railcontent/comment',
            [
                'data' => [
                    'type' => 'comment',
                    'attributes' => $attributes,
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => $content[0]->getId(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals($attributes['comment'], $response->decodeResponseJson('data')[0]['attributes']['comment']);
    }

    public function test_add_comment_on_not_commentable_type_response()
    {
        $this->createAndLogInNewUser();
        $content = $this->fakeContent(
            1,
            [
                'status' => $this->faker->randomElement(ContentRepository::$availableContentStatues),
            ]
        );

        $response = $this->call(
            'PUT',
            'railcontent/comment',
            [
                'data' => [
                    'type' => 'comment',
                    'attributes' => [
                        'comment' => $this->faker->text(),
                    ],
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => $content[0]->getId(),
                            ],
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
                            'data' => [
                                'type' => 'content',
                                'id' => rand(),
                            ],
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

        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
                'status' => $this->faker->randomElement(ContentRepository::$availableContentStatues),
            ]
        );

        $comment = $this->fakeComment(
            [
                'user_id' => $userId,
                'content_id' => $content[0]->getId(),
            ]
        );

        $updatedComment = $this->faker->text();

        $response = $this->call(
            'PATCH',
            'railcontent/comment/' . $comment['id'],
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
            'user' => $userId,

        ];

        $this->assertEquals($updatedComment, $response->decodeResponseJson('data')['attributes']['comment']);
    }

    public function test_update_other_comment_response()
    {
        CommentService::$canManageOtherComments = false;

        $userId = $this->createAndLogInNewUser();
        $randomUser = $this->fakeUser();

        $comment = $this->fakeComment(
            [
                'user_id' => $randomUser['id'],
            ]
        );

        $updatedComment = $this->faker->text();
        $response = $this->call(
            'PATCH',
            'railcontent/comment/' . $comment['id'],
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
                        'temporary_display_name' => '',
                    ],
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => rand(30, 100),
                            ],
                        ],
                        'parent' => [
                            'data' => [
                                'type' => 'comment',
                                'id' => rand(3, 10),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(422, $response->getStatusCode());

        $response->assertJsonFragment(['The selected content id is invalid.']);
        $response->assertJsonFragment(['The selected parent id is invalid.']);
        $response->assertJsonFragment(['The display name field must have a value.']);
    }

    public function test_update_inexistent_comment_response()
    {
        $userId = $this->createAndLogInNewUser();
        $randomId = rand();
        $response = $this->call(
            'PATCH',
            'railcontent/comment/' . $randomId,
            [
                'data' => [
                    'type' => 'comment',
                ],
            ]
        );

        $this->assertEquals(404, $response->getStatusCode());

        $response->assertJsonFragment(['Update failed, comment not found with id: ' . $randomId]);
    }

    public function test_admin_can_update_other_comment_response()
    {
        $userId = $this->createAndLogInNewUser();
        $randomUser = $this->fakeUser();

        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
                'status' => $this->faker->randomElement(ContentRepository::$availableContentStatues),
            ]
        );

        $comment = $this->fakeComment(
            [
                'user_id' => $randomUser['id'],
                'content_id' => $content[0]->getId(),
            ]
        );

        CommentService::$canManageOtherComments = true;
        $updatedComment = $this->faker->text();
        $response = $this->call(
            'PATCH',
            'railcontent/comment/' . $comment['id'],
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

        $comment1 = $this->fakeComment(
            [
                'parent_id' => null,
                'user_id' => $userId,
            ]
        );
        $comment2 = $this->fakeComment(
            [
                'parent_id' => null,
                'user_id' => $userId,
            ]
        );
        $replies = $this->fakeComment(
            [
                'parent_id' => $comment1['id'],
            ]
        );
        $replies = $this->fakeComment(
            [
                'parent_id' => $comment2['id'],
            ]
        );

        $response = $this->call('DELETE', 'railcontent/comment/' . $comment1['id']);

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function test_user_can_not_delete_others_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $randomUser = $this->fakeUser();

        $content = $this->fakeContent();

        $comment = $this->fakeComment(
            [
                'user_id' => $randomUser['id'],
                'content_id' => $content[0]->getId(),
            ]
        );

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
        $randomUser = $this->fakeUser();
        $content = $this->fakeContent();

        $comment = $this->fakeComment(
            [
                'user_id' => $randomUser['id'],
                'content_id' => $content[0]->getId(),
            ]
        );

        $commentId = $comment['id'];

        CommentService::$canManageOtherComments = true;
        CommentRepository::$softDelete = false;

        $response = $this->call('DELETE', 'railcontent/comment/' . $commentId);

        $this->assertEquals(204, $response->getStatusCode());

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'comments',
            [
                'id' => $commentId,
            ]
        );

        CommentRepository::$softDelete = true;
    }

    public function test_reply_to_a_comment()
    {
        $userId = $this->createAndLogInNewUser();
        $reply = $this->faker->paragraph;
        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
            ]
        );
        $comment = $this->fakeComment(
            [
                'content_id' => $content[0]->getId(),
                'parent_id' => null,
            ]
        );

        $response = $this->call(
            'PUT',
            'railcontent/comment/reply',
            [
                'data' => [
                    'type' => 'comment',
                    'attributes' => [
                        'comment' => $reply,
                    ],
                    'relationships' => [
                        'parent' => [
                            'data' => [
                                'type' => 'comment',
                                'id' => $comment['id'],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $expectedResults = [
            [
                'type' => 'comment',
                'id' => 2,
                'attributes' => [
                    'comment' => $reply,
                    'user' => $userId,
                    'temporary_display_name' => '',
                    'created_on' => Carbon::now()
                        ->toDateTimeString(),
                    'deleted_at' => null,
                    'conversation_status' => 'open'
                ],
                "relationships" => [
                    "content" => [
                        "data" => [
                            "type" => "content",
                            "id" => "1",
                        ],
                    ],
                    "user" => [
                        "data" => [
                            "type" => "user",
                            "id" => $userId,
                        ],
                    ]
                ],
            ],
        ];

        $this->assertEquals($expectedResults, $response->decodeResponseJson('data'));

    }

    public function test_reply_to_a_comment_validation_errors()
    {
        $this->createAndLogInNewUser();

        $response = $this->call('PUT', 'railcontent/comment/reply');

        $this->assertEquals(422, $response->getStatusCode());
        $response->assertJsonFragment(['The comment field is required.']);
        $response->assertJsonFragment(['The parent type field is required.']);
        $response->assertJsonFragment(['The parent id field is required.']);
    }

    public function test_pull_comments_when_not_exists()
    {
        $response = $this->call('GET', 'railcontent/comment');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals([], $response->decodeResponseJson('data'));
    }

    public function test_pull_comments_paginated()
    {
        $user = $this->fakeUser();
        $otherUser = $this->fakeUser();

        $limit = 3;
        $totalNumber = $this->faker->numberBetween($limit, ($limit + 25));

        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
                'status' => $this->faker->randomElement(ContentRepository::$availableContentStatues),
            ]
        );

        for ($i = 0; $i < $totalNumber; $i++) {
            $comments[$i] = $this->fakeComment(
                [
                    'user_id' => $otherUser['id'],
                    'content_id' => $content[0]->getId(),
                    'parent_id' => null,
                    'deleted_at' => null,
                ]
            );
        }

        $this->fakeCommentLike(
            [
                'comment_id' => $comments[0]['id'],
                'user_id' => $user['id'],
            ]
        );

        $request = [
            'limit' => $limit,
            'sort' => 'id',
        ];
        $response = $this->call(
            'GET',
            'railcontent/comment',
            $request + ['page' => 1]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $data = $response->decodeResponseJson()['data'];

        $this->assertEquals($request['limit'], count($data));

        $this->assertEquals(1, $response->decodeResponseJson('data')[0]['attributes']['like_count']);
    }

    public function test_pull_content_comments_paginated()
    {
        $page = 2;
        $limit = 3;
        $totalNumber = $this->faker->numberBetween(10, ($limit + 25));
        $user = $this->fakeUser();

        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
                'status' => $this->faker->randomElement(ContentRepository::$availableContentStatues),
            ]
        );

        for ($i = 0; $i < $totalNumber; $i++) {
            $comments[$i] = $this->fakeComment(
                [
                    'content_id' => $content[0]->getId(),
                    'user_id' => $user['id'],
                    'parent_id' => null,
                    'deleted_at' => null,
                ]
            );
        }

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => $page,
                'limit' => $limit,
                'content_id' => 1,
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $data = $response->decodeResponseJson('data');

        $this->assertEquals($limit, count($data));
    }

    public function test_pull_user_comments_paginated()
    {
        $page = 1;
        $limit = 3;
        $totalNumber = $this->faker->numberBetween(3, 10);
        $user = $this->fakeUser();

        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
                'status' => $this->faker->randomElement(ContentRepository::$availableContentStatues),
            ]
        );

        for ($i = 0; $i < $totalNumber; $i++) {
            $comments[$i] = $this->fakeComment(
                [
                    'content_id' => $content[0]->getId(),
                    'user_id' => $user['id'],
                    'parent_id' => null,
                    'deleted_at' => null,
                ]
            );
        }

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => $page,
                'limit' => $limit,
                'user_id' => $user['id'],
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(
            count($comments),
            $response->decodeResponseJson('meta')['pagination']['total']
        );

        $data = $response->decodeResponseJson()['data'];

        $this->assertEquals($limit, count($data));

        foreach ($data as $res) {
            $this->assertEquals($user['id'], $res['attributes']['user']);
        }
    }

    public function test_pull_comments_ordered_by_like_count()
    {
        $user = $this->fakeUser();

        // create content
        $content = $this->fakeContent(
            1,
            [
                'slug' => $this->faker->word,
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
                'status' => ContentService::STATUS_PUBLISHED,
                'brand' => config('railcontent.brand'),
            ]
        );

        // create content comments
        for ($i = 0; $i < 5; $i++) {
            $comments[$i] = $this->fakeComment(
                [
                    'content_id' => $content[0]->getId(),
                    'user_id' => $user['id'],
                    'deleted_at' => null,
                    'parent_id' => null,
                ]
            );
        }

        // select two comment ids
        $firstOrderedCommentId = $comments[2]['id'];
        $secondOrderedCommentId = $comments[4]['id'];

        $this->fakeCommentLike(
            [
                'comment_id' => $comments[2]['id'],
                'user_id' => $this->fakeUser()['id'],
            ]
        );

        $this->fakeCommentLike(
            [
                'comment_id' => $comments[4]['id'],
                'user_id' => $this->fakeUser()['id'],
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => 1,
                'limit' => 25,
                'content_id' => $content[0]->getId(),
                'sort' => '-like_count',
            ]
        );

        $decodedResponse = $response->decodeResponseJson('data');

        // assert the order of results
        $this->assertEquals($decodedResponse[0]['id'], $firstOrderedCommentId);
        $this->assertEquals($decodedResponse[1]['id'], $secondOrderedCommentId);
    }

    public function test_pull_comments_filtered_by_my_comments()
    {
        $currentUserId = $this->createAndLogInNewUser();

        $randomUser = $this->fakeUser();

        $content1 = $this->fakeContent(
            1,
            [
                'brand' => $this->faker->randomElement(config('railcontent.available_brands')),
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
            ]
        );
        $content2 = $this->fakeContent(
            1,
            [
                'brand' => $this->faker->randomElement(config('railcontent.available_brands')),
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
            ]
        );
        $myComment = $this->fakeComment(
            [
                'user_id' => $currentUserId,
                'content_id' => $content1[0]->getId(),
                'deleted_at' => null,
                'parent_id' => null,
            ]
        );

        $replyToMyComment = $this->fakeComment(
            [
                'user_id' => $randomUser['id'],
                'content_id' => $content1[0]->getId(),
                'parent_id' => $myComment['id'],
                'deleted_at' => null,
            ]
        );

        $myCommentsOtherContent = $this->fakeComment(
            [
                'user_id' => $currentUserId,
                'content_id' => $content2[0]->getId(),
                'parent_id' => null,
                'deleted_at' => null,
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => 1,
                'limit' => 25,
                'content_id' => $content1[0]->getId(),
                'sort' => '-mine',
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(1, $response->decodeResponseJson('meta')['pagination']['total']);
    }

    public function test_pull_comments_filtered_by_content_type()
    {
        $page = 1;
        $limit = 3;
        $totalNumber = 10;
        $user = $this->fakeUser();

        $type = $this->faker->randomElement(config('railcontent.commentable_content_types'));

        $content = $this->fakeContent(
            1,
            [
                'type' => $type,
                'brand' => config('railcontent.brand'),
            ]
        );

        for ($i = 0; $i < 10; $i++) {
            $comment[$i] = $this->fakeComment(
                [
                    'content_id' => $content[0]->getId(),
                    'user_id' => $user['id'],
                    'comment' => $this->faker->text,
                    'deleted_at' => null,
                    'parent_id' => null,
                ]
            );
        }

        for ($j = 0; $j < $totalNumber; $j++) {
            $this->fakeComment(
                [
                    'content_id' => $content[0]->getId(),
                    'user_id' => $user['id'],
                    'parent_id' => $comment[0]['id'],
                    'deleted_at' => null,
                ]
            );
        }

        sleep(1);

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => $page,
                'limit' => $limit,
                'content_type' => $type,
                'sort' => 'id',
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $data = $response->decodeResponseJson('data');

        foreach ($data as $comment) {
            $this->assertEquals(
                $type,
                $this->entityManager->getRepository(Content::class)
                    ->find($comment['relationships']['content']['data']['id'])
                    ->getType()
            );
        }
    }

    public function test_pull_comments_filtered_by_brand()
    {
        $page = 1;
        $limit = 3;
        $otherBrand = $this->faker->word;
        $user = $this->fakeUser();

        $contentForBrand1 = $this->fakeContent(
            1,
            [
                'brand' => $otherBrand,
            ]
        );
        $ContentBrandConfig = $this->fakeContent(1);

        for ($i = 0; $i < 7; $i++) {
            $this->fakeComment(
                [
                    'content_id' => $contentForBrand1[0]->getId(),
                    'deleted_at' => null,
                    'parent_id' => null,
                    'user_id' => $user['id'],
                ]
            );
        }
        for ($i = 0; $i < 2; $i++) {
            $this->fakeComment(
                [
                    'content_id' => $ContentBrandConfig[0]->getId(),
                    'deleted_at' => null,
                    'parent_id' => null,
                    'user_id' => $user['id'],
                ]
            );
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
        $this->assertEquals(2, count($response->decodeResponseJson('data')));
    }

    public function test_get_linked_comment()
    {
        $commentsNr = 12;
        $user = $this->fakeUser();

        $content = $this->fakeContent(
            1,
            [
                'brand' => $this->faker->randomElement(config('railcontent.available_brands')),
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
            ]
        );

        $comments = $this->fakeComment(
            [
                'parent_id' => null,
                'user_id' => $user['id'],
                'content_id' => $content[0]->getId(),
                'created_on' => Carbon::parse(now()),
                'deleted_at' => null,
            ]
        );
        for ($i = 0; $i < $commentsNr; $i++) {
            $this->fakeComment(
                [
                    'parent_id' => null,
                    'user_id' => $user['id'],
                    'content_id' => $content[0]->getId(),
                    'created_on' => Carbon::parse(
                        (Carbon::now()
                            ->subDay(2))
                    ),
                    'deleted_at' => null,
                ]
            );
        }

        sleep(1);

        $response = $this->call(
            'GET',
            'railcontent/comment/' . $comments['id'],
            [
                'page' => 1,
                'limit' => 3,
            ]
        );

        $this->assertEquals(3, count($response->decodeResponseJson('data')));
    }

    public function test_pull_comment_with_replies()
    {
        $user = $this->fakeUser();

        $content = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'status' => 'published',
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
            ]
        );

        for ($i = 0; $i < 2; $i++) {
            $comment[$i] = $this->fakeComment(
                [
                    'content_id' => $content[0]->getId(),
                    'user_id' => $user['id'],
                    'parent_id' => null,
                    'deleted_at' => null,
                ]
            );
        }

        $replies = $this->fakeComment(
            [
                'content_id' => $content[0]->getId(),
                'parent_id' => $comment[0]['id'],
                'user_id' => $user['id'],
                'deleted_at' => null,
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => 1,
                'limit' => 3,
                'sort' => 'id',
            ]
        );

        $this->assertEquals(2, count($response->decodeResponseJson('data')));

        $this->assertEquals($comment[0]['id'], $response->decodeResponseJson('data')[0]['id']);
        $this->assertEquals($comment[1]['id'], $response->decodeResponseJson('data')[1]['id']);
    }

    public function test_cache_invalidation()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'status' => 'published',
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
            ]
        );
        for ($i = 0; $i < 3; $i++) {
            $comment[$i] = $this->fakeComment(
                [
                    'parent_id' => null,
                    'user_id' => $userId,
                    'deleted_at' => null,
                    'content_id' => $content[0]->getId(),
                ]
            );
        }

        $replies = $this->fakeComment(
            [
                'parent_id' => $comment[0]['id'],
                'user_id' => $userId,
                'deleted_at' => null,
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => 1,
                'limit' => 10,
                'sort' => 'id',
            ]
        );

        $this->assertEquals(3, count($response->decodeResponseJson('data')));

        $this->assertEquals($comment[0]['id'], $response->decodeResponseJson('data')[0]['id']);
        $this->assertEquals($comment[1]['id'], $response->decodeResponseJson('data')[1]['id']);

        $response = $this->call(
            'PUT',
            'railcontent/comment',
            [
                'data' => [
                    'type' => 'comment',
                    'attributes' => [
                        'comment' => 'roxana',
                    ],
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => $content[0]->getId(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => 1,
                'limit' => 10,
                'sort' => 'id',
            ]
        );

        $this->assertEquals(4, count($response->decodeResponseJson('data')));

        $this->assertEquals($comment[0]['id'], $response->decodeResponseJson('data')[0]['id']);
        $this->assertEquals($comment[1]['id'], $response->decodeResponseJson('data')[1]['id']);

        $response = $this->call('DELETE', 'railcontent/comment/' . $comment[0]['id']);

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => 1,
                'limit' => 10,
                'sort' => 'id',
            ]
        );

        $this->assertEquals(3, count($response->decodeResponseJson('data')));

        CommentService::$canManageOtherComments = true;
        $updatedComment = $this->faker->text();
        $response = $this->call(
            'PATCH',
            'railcontent/comment/' . $comment[1]['id'],
            [
                'data' => [
                    'type' => 'comment',
                    'attributes' => [
                        'comment' => $updatedComment,
                    ],
                ],
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/comment',
            [
                'page' => 1,
                'limit' => 10,
                'sort' => 'id',
            ]
        );

        $this->assertEquals($updatedComment, $response->decodeResponseJson('data')[0]['attributes']['comment']);
    }
}
