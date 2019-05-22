<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentLikeJsonControllerTest extends RailcontentTestCase
{
    protected function setUp()
    {
        parent::setUp();
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

        $response = $this->call(
            'PUT',
            'railcontent/content-like/',
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
                                'id' => $userIdOfLiker,
                            ],
                        ],
                    ],
                ],
            ]
        );

        if ($assertions) {
            $this->assertEquals(200, $response->getStatusCode());

            $this->assertDatabaseHas(
                config('railcontent.table_prefix') . 'content_likes',
                [
                    'content_id' => $content[0]->getId(),
                    'user_id' => $userIdOfLiker,
                ]
            );
        }

        //        $commentRequestResponse = $this->call(
        //            'GET',
        //            'railcontent/comment/' . $commentId
        //        );
        //
        //
        //        $this->assertEquals(1, $commentRequestResponse->decodeResponseJson('data')[0]['attributes']['like_count']);
        //        $this->assertEquals(1, count($commentRequestResponse->decodeResponseJson('data')[0]['attributes']['like_users']));
        //        $this->assertTrue($commentRequestResponse->decodeResponseJson('data')[0]['attributes']['is_liked']);
        return $content[0]->getId();
    }

    // ============================ test cases ======================================

    public function test_user_likes_content()
    {
        $userIdOfLiker = $this->createAndLogInNewUser();

        $this->like($userIdOfLiker, true);
    }

    public function test_user_unlikes_content()
    {
        $userIdOfLiker = $this->createAndLogInNewUser();

        $contentId = $this->like($userIdOfLiker);

        $response = $this->call(
            'DELETE',
            'railcontent/content-like' ,
            [
                'data' => [
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'type' => 'content',
                                'id' => $contentId,
                            ],
                        ],
                        'user' => [
                            'data' => [
                                'type' => 'user',
                                'id' => $userIdOfLiker,
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content_likes',
            [
                'content_id' => $contentId,
                'user_id' => $userIdOfLiker,
            ]
        );
    }

    public function test_index()
    {
        $content = $this->fakeContent();
        $limit = rand(5, 10);

        $contentLikes = $this->fakeContentLike(15,[
            'content' => $content[0]
        ]);

        $response = $this->call(
            'GET',
            'railcontent/content-like/'.$content[0]->getId(),
            [
                'limit' => $limit
            ]);

        $response->assertStatus(200);

        $responseContent = $response->decodeResponseJson('data');

        $this->assertEquals($limit, count($responseContent));

        foreach ($responseContent as $responseRaw) {
            $this->assertEquals($content[0]->getId(), $responseRaw['relationships']['content']['data']['id']);
        }
    }
}
