<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class FullTextSearchJsonControllerTest extends RailcontentTestCase
{
    use ArraySubsetAsserts;

    /**
     * @var ContentFactory $contentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentContentFieldFactory
     */
    protected $fieldFactory;

    /**
     * @var ContentDatumFactory
     */
    protected $datumFactory;

    protected function setUp()
    : void
    {
        $this->setConnectionType('mysql');

        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
        $this->datumFactory = $this->app->make(ContentDatumFactory::class);
    }

    public function test_no_results()
    {
        $response = $this->call('GET', 'railcontent/search');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(
            [],
            $response->decodeResponseJson()
                ->json('data')
        );
        $this->assertEquals(
            0,
            $response->decodeResponseJson()
                ->json('meta')['totalResults']
        );
    }

    public function test_search_results_paginated()
    {
        $page = 1;
        $limit = 3;
        for ($i = 0; $i < 6; $i++) {
            $content[$i] = $this->contentFactory->create(
                'slug',
                $this->faker->randomElement(config('railcontent.showTypes')),
                ContentService::STATUS_PUBLISHED,
                ConfigService::$defaultLanguage,
                ConfigService::$brand,
                rand(),
                Carbon::yesterday()
                    ->hour($i)
                    ->toDateTimeString()
            );

            $titleField[$i] = $this->fieldFactory->create($content[$i]['id'], 'title', 'field '.$i);
            $otherField[$i] = $this->fieldFactory->create($content[$i]['id'], 'name');
            $content[$i]['fields'] = [$titleField[$i], $otherField[$i]];

            $descriptionData =
                $this->datumFactory->create($content[$i]['id'], 'description', 'description '.$this->faker->word);
            $otherData = $this->datumFactory->create($content[$i]['id'], 'other datum '.$i);
            $content[$i]['data'] = [$descriptionData, $otherData];
            $content[$i] = $content[$i]->getArrayCopy();
        }

        //  $this->artisan('command:createSearchIndexesForContents');

        $response = $this->call('GET', 'railcontent/search', [
            'page' => $page,
            'limit' => $limit,
        ]);

        $results = $response->decodeResponseJson();
        $espectedResults = array_splice($content, 0, $limit);

        $this->assertEquals(200, $response->getStatusCode());
        //$this->assertArraySubset($espectedResults, $results['data']);
        $this->assertEquals(6, $results['meta']['totalResults']);
    }

    public function test_search_sort_by_relevance()
    {
        $page = 1;
        $limit = 3;
        for ($i = 0; $i < 5; $i++) {
            $content[$i] = $this->contentFactory->create(
                'slug',
                $this->faker->randomElement(config('railcontent.showTypes')),
                ContentService::STATUS_PUBLISHED,
                ConfigService::$defaultLanguage,
                ConfigService::$brand,
                1,
                Carbon::yesterday()
                    ->hour($i + 1)
                    ->toDateTimeString()
            );

            $titleField[$i] = $this->fieldFactory->create($content[$i]['id'], 'title', $this->faker->word.$i);
            $content[$i]['fields'] = [$titleField[$i]];

            $descriptionData =
                $this->datumFactory->create($content[$i]['id'], 'description', 'description '.$this->faker->word);
            $otherData = $this->datumFactory->create($content[$i]['id'], 'other datum '.$i);
            $content[$i]['data'] = [$descriptionData, $otherData];
            $content[$i] = $content[$i]->getArrayCopy();
        }

        $response = $this->call('GET', 'railcontent/search', [
            'page' => $page,
            'limit' => $limit,
            'term' => $titleField[2]['value'],
        ]);

        //check that first result it's the most relevant
        $this->assertArraySubset(
            [$content[2]],
            array_slice(
                $response->decodeResponseJson()
                    ->json('data'),
                0,
                1
            )
        );
        $this->assertGreaterThanOrEqual(
            1,
            $response->decodeResponseJson()
                ->json('meta')['totalResults']
        );
    }

    public function test_search_with_sort_and_content_type_criteria()
    {
        $page = 1;
        $limit = 3;
        for ($i = 0; $i < 6; $i++) {
            $content[$i] = $this->contentFactory->create(
                'slug',
                $this->faker->randomElement(config('railcontent.showTypes')),
                $this->faker->randomElement([ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED]),
                ConfigService::$defaultLanguage,
                ConfigService::$brand,
                rand(),
                Carbon::yesterday()
                    ->hour($i)
                    ->toDateTimeString()
            );

            $titleField[$i] = $this->fieldFactory->create($content[$i]['id'], 'title', 'field '.$i);
            $otherField[$i] = $this->fieldFactory->create($content[$i]['id'], 'album');
            $content[$i]['fields'] = [$titleField[$i], $otherField[$i]];

            $descriptionData =
                $this->datumFactory->create($content[$i]['id'], 'description', 'description '.$this->faker->word);
            $otherData = $this->datumFactory->create($content[$i]['id'], 'other datum '.$i);
            $content[$i]['data'] = [$descriptionData, $otherData];
            $content[$i] = array_merge($content[$i]->getArrayCopy(), ['pluck' => $content[$i]->dot()]);
        }

        $this->artisan('command:createSearchIndexesForContents');

        $contentType = $this->faker->randomElement(config('railcontent.showTypes'));
        $response = $this->call('GET', 'railcontent/search', [
            'page' => $page,
            'limit' => $limit,
            'sort' => '-content_published_on',
            'included_types' => [$contentType],
        ]);

        $results =
            $response->decodeResponseJson()
                ->json('data');

        $expectedResults = $this->call('GET', 'railcontent/content', [
            'page' => $page,
            'limit' => $limit,
            'sort' => '-published_on',
            'included_types' => [$contentType],
        ]);

        $this->assertEquals(
            $expectedResults->decodeResponseJson()
                ->json('data'),
            array_values($results)
        );
    }

    public function test_search_with_status()
    {
        $page = 1;
        $limit = 3;
        for ($i = 0; $i < 6; $i++) {
            $content[$i] = $this->contentFactory->create(
                'slug',
                $this->faker->randomElement(config('railcontent.showTypes')),
                $this->faker->randomElement([ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED]),
                ConfigService::$defaultLanguage,
                ConfigService::$brand,
                rand(),
                Carbon::yesterday()
                    ->hour($i)
                    ->toDateTimeString()
            );
            $content[$i] = array_merge($content[$i]->getArrayCopy(), ['pluck' => $content[$i]->dot()]);
        }

        $this->artisan('command:createSearchIndexesForContents');

        $contentStatus =
            $this->faker->randomElement([ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED]);
        $response = $this->call('GET', 'railcontent/search', [
            'page' => $page,
            'limit' => $limit,
            'sort' => '-content_published_on',
            'statuses' => [$contentStatus],
        ]);

        $results =
            $response->decodeResponseJson()
                ->json('data');

        $expectedResults = $this->call('GET', 'railcontent/content', [
            'page' => $page,
            'limit' => $limit,
            'sort' => '-published_on',
            'statuses' => [$contentStatus],
            'auth_level' => 'administrator',
        ]);

        $this->assertEquals(
            $expectedResults->decodeResponseJson()
                ->json('data'),
            array_values($results)
        );
    }

    public function test_search_for_coach_content()
    {
        $page = 1;
        $limit = 3;

        $slug = $this->faker->word;
        $instructor = $this->contentFactory->create($slug, 'instructor', 'published');

        $coach = $this->contentFactory->create($slug, 'coach', 'published');

        $fieldInstructor = [
            'key' => 'instructor',
            'value' => $instructor['id'],
            'type' => 'content_id',
        ];

        $this->contentFactory->create(
            'slug',
            $this->faker->randomElement(config('railcontent.showTypes')),
            $this->faker->randomElement([ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED]),
            ConfigService::$defaultLanguage,
            ConfigService::$brand,
            rand(),
            Carbon::yesterday()
                ->toDateTimeString()
        );

        for ($i = 0; $i < 6; $i++) {
            $contentType = $this->faker->randomElement(config('railcontent.showTypes'));
            $content[$i] = $this->contentFactory->create(
                'slug',
                $contentType,
                $this->faker->randomElement([ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED]),
                ConfigService::$defaultLanguage,
                ConfigService::$brand,
                rand(),
                Carbon::yesterday()
                    ->hour($i)
                    ->toDateTimeString()
            );
            $this->fieldFactory->create(
                $content[$i]['id'],
                $fieldInstructor['key'],
                $fieldInstructor['value'],
                1,
                $fieldInstructor['type']
            );
            $content[$i] = array_merge($content[$i]->getArrayCopy(), ['pluck' => $content[$i]->dot()]);
        }

        $this->artisan('command:createSearchIndexesForContents');

        $response = $this->call('GET', 'railcontent/search', [
            'page' => $page,
            'limit' => $limit,
            'sort' => '-content_published_on',
            'included_types' => [$contentType],
            'included_fields' => ['instructor,'.$coach['id']],
        ]);

        $results =
            $response->decodeResponseJson()
                ->json('data');

        foreach ($results as $result) {
            $this->assertEquals($instructor['id'], $result['fields'][0]['value']['id']);
        }
    }

    public function test_search_for_coach_content_no_content()
    {
        $page = 1;
        $limit = 3;

        $coach = $this->contentFactory->create($this->faker->word, 'coach', 'published');

        $this->contentFactory->create(
            'slug',
            $this->faker->randomElement(config('railcontent.showTypes')),
            $this->faker->randomElement([ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED]),
            ConfigService::$defaultLanguage,
            ConfigService::$brand,
            rand(),
            Carbon::yesterday()
                ->toDateTimeString()
        );

        //        for ($i = 0; $i < 6; $i++) {
        //            $content[$i] = $this->contentFactory->create(
        //                'slug',
        //                $this->faker->randomElement(config('railcontent.showTypes')),
        //                $this->faker->randomElement([ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED]),
        //                ConfigService::$defaultLanguage,
        //                ConfigService::$brand,
        //                rand(),
        //                Carbon::yesterday()
        //                    ->hour($i)
        //                    ->toDateTimeString()
        //            );
        //
        //            $content[$i] = array_merge($content[$i]->getArrayCopy(), ['pluck' => $content[$i]->dot()]);
        //        }

        $this->artisan('command:createSearchIndexesForContents');

        $response = $this->call('GET', 'railcontent/search', [
            'page' => $page,
            'limit' => $limit,
            'sort' => '-content_published_on',
            'included_fields' => ['instructor,'.$coach['id']],
        ]);

        $results = $response->decodeResponseJson();

        $this->assertEquals(0, $results['meta']['totalResults']);
    }

    public function test_popularity_command()
    {
        $this->createAndLogInNewUser();

        $content1 = $this->contentFactory->create(
            $this->faker->word,
            'course',
            'published',
            null,
            null,
            null,
            Carbon::now()
                ->subDays(2)
        );
        $content2 = $this->contentFactory->create(
            $this->faker->word,
            'course',
            'published',
            null,
            null,
            null,
            Carbon::now()
        );
        $content3 = $this->contentFactory->create($this->faker->word, 'course', 'published');

        $userContent1 = [
            'content_id' => $content1['id'],
            'user_id' => rand(),
            'state' => UserContentProgressService::STATE_STARTED,
            'progress_percent' => $this->faker->numberBetween(0, 99),
            'updated_on' => Carbon::now()
                ->toDateString(),
        ];

        $userContent2 = [
            'content_id' => $content2['id'],
            'user_id' => rand(),
            'state' => UserContentProgressService::STATE_COMPLETED,
            'progress_percent' => $this->faker->numberBetween(0, 99),
            'updated_on' => Carbon::now()
                ->toDateString(),
        ];

        $userContent3 = [
            'content_id' => $content2['id'],
            'user_id' => rand(),
            'state' => UserContentProgressService::STATE_STARTED,
            'progress_percent' => $this->faker->numberBetween(0, 99),
            'updated_on' => Carbon::now()
                ->toDateString(),
        ];

        $this->query()
            ->table(ConfigService::$tableUserContentProgress)
            ->insertGetId($userContent1);
        $this->query()
            ->table(ConfigService::$tableUserContentProgress)
            ->insertGetId($userContent2);
        $this->query()
            ->table(ConfigService::$tableUserContentProgress)
            ->insertGetId($userContent3);

        $this->artisan('CalculateContentPopularity');

        $this->assertDatabaseHas(ConfigService::$tableContent, [
            'id' => $content1['id'],
            'popularity' => 1,
        ]);

        $this->assertDatabaseHas(ConfigService::$tableContent, [
            'id' => $content2['id'],
            'popularity' => 8,
        ]);

        $this->assertDatabaseHas(ConfigService::$tableContent, [
            'id' => $content3['id'],
            'popularity' => 0,
        ]);
    }
}
