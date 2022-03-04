<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers\NewStructure;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentFollowJsonControllerTest extends RailcontentTestCase
{
    protected function setUp()
    {
        parent::setUp();
        ResponseService::$oldResponseStructure = false;
    }

    public function test_user_follow_content()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
                'status' => $this->faker->randomElement(ContentRepository::$availableContentStatues),
                'brand' => config('railcontent.brand'),
            ]
        );


        $response = $this->call(
            'PUT',
            'railcontent/follow',
            [
                'data' => [
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => $content[0]->getId(),
                            ],
                        ],
                        'user' => [
                            'data' => [
                                'type' => 'user',
                                'id' => $userId,
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertDatabaseHas(
            config('railcontent.table_prefix') . 'content_follows',
            [
                'content_id' => $content[0]->getId(),
                'user_id' => $userId,
            ]
        );
    }

    public function test_user_unfollow_content()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
                'status' => $this->faker->randomElement(ContentRepository::$availableContentStatues),
                'brand' => config('railcontent.brand'),
            ]
        );

        $this->call(
            'PUT',
            'railcontent/follow' ,
            [
                'data' => [
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => $content[0]->getId(),
                            ],
                        ],
                        'user' => [
                            'data' => [
                                'type' => 'user',
                                'id' => $userId,
                            ],
                        ],
                    ],
                ],
            ]
        );

        $response = $this->call(
            'PUT',
            'railcontent/unfollow' ,
            [
                'data' => [
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => $content[0]->getId(),
                            ],
                        ],
                        'user' => [
                            'data' => [
                                'type' => 'user',
                                'id' => $userId,
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(204, $response->getStatusCode());

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content_follows',
            [
                'content_id' => $content[0]->getId(),
                'user_id' => $userId,
            ]
        );
    }

    public function test_get_user_followed_content()
    {
        $content = $this->fakeContent(
            1,
            [
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
                'status' => $this->faker->randomElement(ContentRepository::$availableContentStatues),
                'brand' => config('railcontent.brand'),
            ]
        );

        $user = $this->createAndLogInNewUser();
        $limit = 6;

        for($i = 0; $i< 15; $i++) {
            $contentLikes[$i] = $this->fakeUserContentFollow(
                         [
                    'content_id' => $content[0]->getId(),
                             'user_id' => $user
                ]
            );
        }

        $response = $this->call(
            'GET',
            'railcontent/followed-content',
            [
                'limit' => $limit,
                'content_type' => $content[0]->getType()
            ]);

        $response->assertStatus(200);

        $responseContent = $response->decodeResponseJson('data');

        $this->assertEquals($limit, count($responseContent));

        foreach ($responseContent as $responseRaw) {
            $this->assertEquals($content[0]->getId(), $responseRaw['id']);
        }
    }

    public function test_only_followed_content()
    {
        $content = $this->fakeContent(
            5,
            [
                'type' => $this->faker->randomElement(config('railcontent.commentable_content_types')),
                'status' => $this->faker->randomElement(ContentRepository::$availableContentStatues),
                'brand' => config('railcontent.brand'),
            ]
        );

        $user = $this->createAndLogInNewUser();

        for($i = 0; $i< 2; $i++) {
            $contentLikes[$i] = $this->fakeUserContentFollow(
                [
                    'content_id' => $content[$i]->getId(),
                    'user_id' => $user
                ]
            );
        }

        sleep(1);

        $response = $this->call('GET', 'railcontent/content', [
            'page' => 1,
            'limit' => 10,
            'statues' => ['published'],
            'sort' => 'id',
            'included_types' => [$content[0]->getType()],
            'only_subscribed' => true
        ]);

        $response->assertStatus(200);

        $responseContent = $response->decodeResponseJson('data');

        $this->assertEquals(2, count($responseContent));

        foreach ($responseContent as $index=>$responseRaw) {
            $this->assertEquals($content[$index]->getId(), $responseRaw['id']);
        }
    }
}
