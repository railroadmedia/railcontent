<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class FullTextSearchJsonControllerTest extends RailcontentTestCase
{
    protected function setUp()
    {
        $this->setConnectionType('mysql');

        parent::setUp();
    }

    public function test_no_results()
    {
        $response = $this->call('GET', 'railcontent/search');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([], $response->decodeResponseJson('data'));
        $this->assertEquals(0, $response->decodeResponseJson('meta')['pagination']['total']);
    }

    public function test_search_results_paginated()
    {
        $page = 1;
        $limit = 10;

        $content1 = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'type' => 'courses',
                'title' => $this->faker->word,
                'publishedOn' => Carbon::now(),
                'status' => 'published',
            ]
        );
        $this->fakeContentTopic(
            15,
            [
                'content' => $content1[0],
                'topic' => $this->faker->word,
            ]
        );
        $content2 = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'type' => 'courses',
                'title' => $this->faker->word,
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );
        $this->fakeContentTopic(
            15,
            [
                'content' => $content2[0],
                'topic' => $this->faker->word,
            ]
        );

        $contents = $this->fakeContent(
            10,
            [
                'brand' => config('railcontent.brand'),
                'type' => 'courses',
                'title' => $this->faker->word,
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $this->artisan('command:createSearchIndexesForContents');

        $response = $this->call(
            'GET',
            'railcontent/search',
            [
                'page' => $page,
                'limit' => $limit,
                'term' => $content1[0]->getTitle(),
            ]
        );

        $results = $response->decodeResponseJson('data');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertTrue(strcmp($content1[0]->getTitle(), $results[0]['attributes']['title']) >= 0);

    }

    public function test_search_with_sort_and_content_type_criteria()
    {
        $page = 1;
        $limit = 10;

        $content1 = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'type' => $this->faker->randomElement(config('railcontent.searchable_content_types')),
                'title' => $this->faker->word,
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $content2 = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'type' => $this->faker->randomElement(config('railcontent.searchable_content_types')),
                'title' => $this->faker->word,
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $contents = $this->fakeContent(
            10,
            [
                'brand' => config('railcontent.brand'),
                'type' => $this->faker->randomElement(config('railcontent.searchable_content_types')),
                'title' => $this->faker->word,
                'status' => 'published',
                'publishedOn' => Carbon::now(),
            ]
        );

        $this->artisan('command:createSearchIndexesForContents');

        $response = $this->call(
            'GET',
            'railcontent/search',
            [
                'page' => $page,
                'limit' => $limit,
                'term' => $content1[0]->getTitle(),
                'included_types' => config('railcontent.searchable_content_types'),
            ]
        );

        $results = $response->decodeResponseJson('data');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(count($results) > 0);

        foreach ($results as $result) {
            $this->assertTrue(in_array($result['attributes']['type'], config('railcontent.searchable_content_types')));
        }
    }

    public function test_search_with_status()
    {
        $page = 1;
        $limit = 10;

        $content1 = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
                'type' => $this->faker->randomElement(config('railcontent.searchable_content_types')),
                'status' => $this->faker->randomElement(
                    [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED]
                ),
            ]
        );

        $content2 = $this->fakeContent(
            1,
            [
                'brand' => config('railcontent.brand'),
                'type' => $this->faker->randomElement(config('railcontent.searchable_content_types')),
                'publishedOn' => Carbon::now(),
                'status' => $this->faker->randomElement(
                    [ContentService::STATUS_DELETED, ContentService::STATUS_ARCHIVED]
                ),
            ]
        );

        $contents = $this->fakeContent(
            10,
            [
                'brand' => config('railcontent.brand'),
                'type' => $this->faker->randomElement(config('railcontent.searchable_content_types')),
                'publishedOn' => Carbon::now(),
                'status' => $this->faker->randomElement(
                    [ContentService::STATUS_DRAFT, ContentService::STATUS_SCHEDULED]
                ),
            ]
        );

        $contentStatus =
            $this->faker->randomElement([ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED]);

        $this->artisan('command:createSearchIndexesForContents');

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

        $this->assertEquals(200, $response->getStatusCode());

        foreach ($results as $result) {
            $this->assertEquals($result['attributes']['status'], $contentStatus);
        }
    }
}
