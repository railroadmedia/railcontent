<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentProgressJsonControllerTest extends RailcontentTestCase
{
    use ArraySubsetAsserts;

    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    protected $serviceBeingTested;

    protected $userId;

    public function test_start_content()
    {
        $content = $this->contentFactory->create();
        $response = $this->put(
            'railcontent/start',
            [
                'content_id' => $content['id'],
            ]
        );

        $this->assertEquals(200, $response->status());
        $this->assertTrue($response->decodeResponseJson()->json('data')[0][0]);
    }

    public function test_start_content_invalid_content_id()
    {
        $response = $this->put(
            'railcontent/start',
            [
                'content_id' => 1,
            ]
        );

        $this->assertEquals(422, $response->status());
        $responseContent = $response->decodeResponseJson()->json('meta');
        $responseErrors = $responseContent['errors'];

        $expectedErrors = [
            "source" => "content_id",
            "detail" => "The selected content id is invalid.",
        ];

        $this->assertEquals([$expectedErrors], $responseErrors);
    }

    public function test_complete_content()
    {
        $content = $this->contentFactory->create();
        $response = $this->put(
            'railcontent/start',
            [
                'content_id' => $content['id'],
            ]
        );


        $response = $this->put(
            'railcontent/complete',
            [
                'content_id' => $content['id'],
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson()->json('data')[0][0]);
        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'content_id' => $content['id'],
                'user_id' => $this->userId,
                'state' => UserContentProgressService::STATE_COMPLETED,
                'progress_percent' => 100,
                'updated_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
    }

    public function test_complete_content_invalid_content_id()
    {
        $response = $this->put(
            'railcontent/complete',
            [
                'content_id' => 1,
            ]
        );

        $this->assertEquals(422, $response->status());
        $responseContent = $response->decodeResponseJson()->json('meta');
        $responseErrors = $responseContent['errors'];

        $expectedErrors = [
            "source" => "content_id",
            "detail" => "The selected content id is invalid.",
        ];

        $this->assertEquals([$expectedErrors], $responseErrors);
    }

    public function test_save_user_progress_on_content()
    {
        $content = $this->contentFactory->create();

        $userContent = [
            'content_id' => $content['id'],
            'user_id' => $this->userId,
            'state' => UserContentProgressService::STATE_STARTED,
            'progress_percent' => $this->faker->numberBetween(0, 10),
            'updated_on' => Carbon::now()
                ->toDateTimeString(),
        ];

        $this->query()
            ->table(ConfigService::$tableUserContentProgress)
            ->insertGetId($userContent);

        $response = $this->put(
            'railcontent/progress',
            [
                'content_id' => $content['id'],
                'progress_percent' => $this->faker->numberBetween(10, 99),
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson()->json('data')[0][0]);
    }

    public function test_save_user_progress_on_content_inexistent()
    {
        $contentId = $this->faker->numberBetween();

        $response = $this->put(
            'railcontent/progress',
            [
                'content_id' => $contentId,
                'progress_percent' => $this->faker->numberBetween(10, 99),
            ]
        );

        $this->assertEquals(422, $response->status());

        $responseContent = $response->decodeResponseJson()->json('meta');
        $responseErrors = $responseContent['errors'];

        $expectedErrors = [
            "source" => "content_id",
            "detail" => "The selected content id is invalid.",
        ];

        $this->assertEquals([$expectedErrors], $responseErrors);
    }

    public function test_in_progress_contents()
    {
        $user = $this->createAndLogInNewUser();

        for ($i = 1; $i < 15; $i++) {
            $courses[$i] = $this->contentFactory->create(
                $this->faker->word,
                'course',
                ContentService::STATUS_PUBLISHED
            );
        }

        $userContent = [
            'content_id' => $courses[2]['id'],
            'user_id' => $user,
            'state' => UserContentProgressService::STATE_STARTED,
            'progress_percent' => $this->faker->numberBetween(0, 10),
            'updated_on' => Carbon::now()
                ->toDateTimeString(),
        ];

        $this->query()
            ->table(ConfigService::$tableUserContentProgress)
            ->insertGetId($userContent);

        $userContent = [
            'content_id' => $courses[4]['id'],
            'user_id' => $user,
            'state' => UserContentProgressService::STATE_STARTED,
            'progress_percent' => $this->faker->numberBetween(0, 10),
            'updated_on' => Carbon::now()
                ->toDateTimeString(),
        ];

        $this->query()
            ->table(ConfigService::$tableUserContentProgress)
            ->insertGetId($userContent);

        $response = $this->call(
            'GET',
            'api/railcontent/in-progress',
            [
                'included_types' => ['course'],
                'statuses' => ['published', 'scheduled'],
                'sort' => 'published_on',
                'brand' => config('railcontent.brand'),
                'limit' => 10,
            ]

        );
        $results = $response->decodeResponseJson()->json('data');

        $this->assertTrue(count($results) <= 10);

        foreach ($results as $result) {
            $this->assertEquals('course', $result['type']);
            $this->assertTrue(in_array($result['id'], [2, 4]));
            $this->assertEquals($result['brand'], config('railcontent.brand'));
        }
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->serviceBeingTested = $this->app->make(ContentService::class);
        $this->classBeingTested = $this->app->make(ContentRepository::class);
        $this->userId = $this->createAndLogInNewUser();
    }
}
