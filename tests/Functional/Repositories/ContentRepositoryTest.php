<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentRepositoryTest extends RailcontentTestCase
{
    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);
    }

    public function test_get()
    {
        $content = [
            'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $response = $this->classBeingTested->get($contentId);

        $this->assertEquals(
            $response,
            $content
        );
    }

    public function test_get_many()
    {
        // content that is linked via a field
        $linkedContent = [
            'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $linkedContentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($linkedContent);

        $linkedFieldKey = $this->faker->word;
        $linkedFieldValue = $this->faker->word;

        $linkedFieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $linkedFieldKey,
                'value' => $linkedFieldValue,
                'type' => 'string',
                'position' => null,
            ]
        );

        $linkedContentFieldLinkId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $linkedContentId,
                'field_id' => $linkedFieldId,
            ]
        );

        // main content
        $content = [
            'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $fieldKey = $this->faker->word;

        $fieldId = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $fieldKey,
                'value' => $linkedContentId,
                'type' => 'content_id',
                'position' => null,
            ]
        );

        $contentFieldLinkId = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $fieldId,
            ]
        );

        // Add a multiple key field
        $multipleKeyFieldKey = $this->faker->word;
        $multipleKeyFieldValues = [$this->faker->word, $this->faker->word, $this->faker->word];

        $multipleField1 = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $multipleKeyFieldKey,
                'value' => $multipleKeyFieldValues[0],
                'type' => 'multiple',
                'position' => 0,
            ]
        );

        $multipleFieldLink1 = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $multipleField1,
            ]
        );

        $multipleField2 = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $multipleKeyFieldKey,
                'value' => $multipleKeyFieldValues[2],
                'type' => 'multiple',
                'position' => 2,
            ]
        );

        $multipleFieldLink2 = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $multipleField2,
            ]
        );

        $multipleField3 = $this->query()->table(ConfigService::$tableFields)->insertGetId(
            [
                'key' => $multipleKeyFieldKey,
                'value' => $multipleKeyFieldValues[1],
                'type' => 'multiple',
                'position' => 1,
            ]
        );

        $multipleFieldLink3 = $this->query()->table(ConfigService::$tableContentFields)->insertGetId(
            [
                'content_id' => $contentId,
                'field_id' => $multipleField3,
            ]
        );

        $response = $this->classBeingTested->getManyById([$contentId]);

        $this->assertEquals(
            [
                2 => [
                    "slug" => $content["slug"],
                    "status" => $content["status"],
                    "type" => $content["type"],
                    "position" => $content["position"],
                    "parent_id" => $content["parent_id"],
                    "published_on" => $content["published_on"],
                    "created_on" => $content["created_on"],
                    "archived_on" => $content["archived_on"],
                    "fields" => [
                        $fieldKey => [
                            "slug" => $linkedContent["slug"],
                            "status" => $linkedContent["status"],
                            "type" => $linkedContent["type"],
                            "position" => $linkedContent["position"],
                            "parent_id" => $linkedContent["parent_id"],
                            "published_on" => $linkedContent["published_on"],
                            "created_on" => $linkedContent["created_on"],
                            "archived_on" => $linkedContent["archived_on"],
                            "fields" => [
                                $linkedFieldKey => $linkedFieldValue,
                            ]
                        ],
                        $multipleKeyFieldKey => $multipleKeyFieldValues
                    ],
                ]
            ],
            $response
        );
    }

    /**
     * @return \Illuminate\Database\Connection
     */
    private function query()
    {
        return $this->databaseManager->connection();
    }
}