<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Config;
use Carbon\Carbon;
use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentDatumFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class FullTextSearchJsonControllerTest extends RailcontentTestCase
{
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
        $this->assertEquals([], $response->decodeResponseJson('data'));
        $this->assertEquals(0, $response->decodeResponseJson('meta')['totalResults']);
    }

    public function test_search_results_paginated()
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

            $titleField[$i] = $this->fieldFactory->create($content[$i]['id'], 'title', 'field ' . $i);
            $otherField[$i] = $this->fieldFactory->create($content[$i]['id'], 'other field ' . $i);
            $content[$i]['fields'] = [$titleField[$i], $otherField[$i]];

            $descriptionData =
                $this->datumFactory->create($content[$i]['id'], 'description', 'description ' . $this->faker->word);
            $otherData = $this->datumFactory->create($content[$i]['id'], 'other datum ' . $i);
            $content[$i]['data'] = [$descriptionData, $otherData];
            $content[$i] = $content[$i]->getArrayCopy();
        }

        $this->artisan('command:createSearchIndexesForContents');

        $response = $this->call(
            'GET',
            'railcontent/search',
            [
                'page' => $page,
                'limit' => $limit,
            ]
        );

        $results = $response->decodeResponseJson();
        $espectedResults = array_splice($content, 0, $limit);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset($espectedResults, $results['data']);
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

            $titleField[$i] = $this->fieldFactory->create($content[$i]['id'], 'title', $this->faker->text(10) . $i);
            $otherField[$i] = $this->fieldFactory->create($content[$i]['id'], $this->faker->word . $i);
            $content[$i]['fields'] = [$titleField[$i], $otherField[$i]];

            $descriptionData =
                $this->datumFactory->create($content[$i]['id'], 'description', 'description ' . $this->faker->word);
            $otherData = $this->datumFactory->create($content[$i]['id'], 'other datum ' . $i);
            $content[$i]['data'] = [$descriptionData, $otherData];
            $content[$i] = $content[$i]->getArrayCopy();
        }

        $this->artisan('command:createSearchIndexesForContents');

        $response = $this->call(
            'GET',
            'railcontent/search',
            [
                'page' => $page,
                'limit' => $limit,
                'term' => $titleField[2]['value'] . ' ' . $otherField[2]['value'],
            ]
        );

        //check that first result it's the most relevant
        $this->assertArraySubset([$content[2]], array_slice($response->decodeResponseJson('data'), 0, 1));
        $this->assertGreaterThanOrEqual(1, $response->decodeResponseJson('meta')['totalResults']);
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

            $titleField[$i] = $this->fieldFactory->create($content[$i]['id'], 'title', 'field ' . $i);
            $otherField[$i] = $this->fieldFactory->create($content[$i]['id'], 'other field ' . $i);
            $content[$i]['fields'] = [$titleField[$i], $otherField[$i]];

            $descriptionData =
                $this->datumFactory->create($content[$i]['id'], 'description', 'description ' . $this->faker->word);
            $otherData = $this->datumFactory->create($content[$i]['id'], 'other datum ' . $i);
            $content[$i]['data'] = [$descriptionData, $otherData];
            $content[$i] = array_merge($content[$i]->getArrayCopy(), ['pluck' => $content[$i]->dot()]);
        }

        $this->artisan('command:createSearchIndexesForContents');

        $contentType = $this->faker->randomElement(config('railcontent.showTypes'));
        $response = $this->call(
            'GET',
            'railcontent/search',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => '-content_published_on',
                'included_types' => [$contentType],
            ]
        );

        $results = $response->decodeResponseJson('data');

        $expectedResults = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => '-published_on',
                'included_types' => [$contentType],
            ]
        );

        $this->assertEquals($expectedResults->decodeResponseJson('data'), array_values($results));
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
        $response = $this->call(
            'GET',
            'railcontent/search',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => '-content_published_on',
                'statuses' => [$contentStatus],
            ]
        );

        $results = $response->decodeResponseJson('data');

        $expectedResults = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => '-published_on',
                'statuses' => [$contentStatus],
                'auth_level' => 'administrator',
            ]
        );

        $this->assertEquals($expectedResults->decodeResponseJson('data'), array_values($results));
    }

    public function test_search_for_coach_content()
    {
        $page = 1;
        $limit = 3;

        $instructor = $this->contentFactory->create($this->faker->word, 'instructor', 'published');

        $coach = $this->contentFactory->create($this->faker->word, 'coach', 'published');

        $fieldInstructor = [
            'key' => 'instructor',
            'value' => $instructor['id'],
            'type' => 'content_id',
        ];

        Config::set('railcontent.coach_id_instructor_id_mapping', [$coach['id'] => $instructor['id']]);

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
            $this->fieldFactory->create(
                $content[$i]['id'],
                $fieldInstructor['key'],
                $fieldInstructor['value'],
                null,
                $fieldInstructor['type']
            );
            $content[$i] = array_merge($content[$i]->getArrayCopy(), ['pluck' => $content[$i]->dot()]);
        }

        $this->artisan('command:createSearchIndexesForContents');

        $response = $this->call(
            'GET',
            'railcontent/search',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => '-content_published_on',
                'coach_ids' => [$coach['id']]
            ]
        );

        $results = $response->decodeResponseJson('data');

        foreach ($results as $result)
        {
            $this->assertEquals($instructor['id'],$result['fields'][0]['value']['id']);
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

        $response = $this->call(
            'GET',
            'railcontent/search',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => '-content_published_on',
                'coach_ids' => [$coach['id']]
            ]
        );

        $results = $response->decodeResponseJson();

            $this->assertEquals(0,$results['meta']['totalResults']);

    }
}
