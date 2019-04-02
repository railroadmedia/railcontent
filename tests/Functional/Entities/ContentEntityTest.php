<?php

namespace Railroad\Railcontent\Tests\Functional\Entities;

use Carbon\Carbon;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentEntityTest extends RailcontentTestCase
{
    /**
     * @var ContentService
     */
    protected $serviceBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(ContentService::class);

    }

    public function test_get_by_entity_mapping()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'status' => 'published',
            ]
        );

        $contentTopic = $this->fakeContentTopic(
            3,
            [
                'content' => $content[0],
            ]
        );

        $instructor = $this->fakeContent();
        $contentInstructor = $this->fakeContentInstructor(
            1,
            [
                'content' => $content[0],
                'instructor' => $instructor[0],
            ]
        );

        $contentData = $this->fakeContentData(
            1,
            [
                'content' => $content[0],
                'key' => $this->faker->word,
                'value' => $this->faker->paragraph,
            ]
        );

        $permission = $this->fakePermission(
            1,
            [
                'brand' => config('railcontent.brand'),
            ]
        );

        $contentPermission = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'data' => [
                    'type' => 'contentPermission',
                    'attributes' => [
                        'content_type' => $content[0]->getType(),
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $permission[0]->getId(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $userPermission = $this->fakeUserPermission(
            1,
            [
                'userId' => $userId,
                'permission' => $permission[0],
                'startDate' => Carbon::now(),
                'expirationDate' => Carbon::now()
                    ->addYear(1),
            ]
        );

        $results = $this->serviceBeingTested->getById($content[0]->getId());

        $this->assertInstanceOf(Content::class, $results);

        $this->assertEquals($content[0]->getId(), $results->getId());
        $this->assertEquals($content[0]->getSlug(), $results->getSlug());
        $this->assertEquals($content[0]->getType(), $results->getType());
        $this->assertEquals($content[0]->getSort(), $results->getSort());
        $this->assertEquals($content[0]->getStatus(), $results->getStatus());
        $this->assertEquals($content[0]->getLanguage(), $results->getLanguage());
        $this->assertEquals($content[0]->getBrand(), $results->getBrand());
        $this->assertEquals($content[0]->getPublishedOn(), $results->getPublishedOn());
        $this->assertEquals($content[0]->getCreatedOn(), $results->getCreatedOn());
        $this->assertEquals($content[0]->getArchivedOn(), $results->getArchivedOn());

        $this->assertEquals(count($contentTopic), count($results->getTopic()));
        foreach ($results->getTopic() as $index => $topic) {
            $this->assertEquals($contentTopic[$index]->getId(), $topic->getId());
        }

        $this->assertEquals($instructor[0]->getId(), $results->getInstructor()->getInstructor()->getId());


        $this->assertEquals(count($contentData), count($results->getData()));
        foreach ($results->getData() as $index => $data) {
            $this->assertEquals($contentData[$index]->getId(), $data->getId());
        }

        $this->assertEquals(1, count($results->getProperty('permissions')));
        $this->assertEquals($content[0]->getType(), $results->getProperty('permissions')[0]->getContentType());
        $this->assertEquals($permission[0]->getName(), $results->getProperty('permissions')[0]->getPermission()->getName());

    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('cache.default', 'array');
    }
}
