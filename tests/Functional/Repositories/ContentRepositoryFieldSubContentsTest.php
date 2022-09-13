<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\ContentContentFieldFactory;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentRepositoryFieldSubContentsTest extends RailcontentTestCase
{
    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentContentFieldFactory
     */
    protected $fieldFactory;

    public function test_sub_content_id_field_is_replace_by_content()
    {
        $type = $this->faker->word;

        $content = $this->contentFactory->create(
            ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
            $type,
            ContentService::STATUS_PUBLISHED
        );

        $subContent = $this->contentFactory->create(
            ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
            $type,
            ContentService::STATUS_PUBLISHED
        );

        $field = $this->fieldFactory->create(
            $content['id'],
            $this->faker->word,
            $subContent['id'],
            1,
            'content_id'
        );

        $result = $this->classBeingTested->getById($content['id']);

        $this->assertEquals('content', $result['fields'][0]['type']);
        $this->assertEquals($subContent->getArrayCopy(), $result['fields'][0]['value']);
    }

    public function test_sub_content_id_field_is_replace_by_content_multiple()
    {
        $type = $this->faker->word;

        $content = $this->contentFactory->create(
            ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
            $type,
            ContentService::STATUS_PUBLISHED
        );

        $subContents = [];

        for ($i = 0; $i < 3; $i++) {
            $subContent = $this->contentFactory->create(
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $type,
                ContentService::STATUS_PUBLISHED
            );

            $field = $this->fieldFactory->create(
                $content['id'],
                $this->faker->word,
                $subContent['id'],
                $i,
                'content_id'
            );

            $subContents[] = $subContent;
        }

        $result = $this->classBeingTested->getById($content['id']);

        $this->assertEquals('content', $result['fields'][0]['type']);
        $this->assertEquals($subContents[0]->getArrayCopy(), $result['fields'][0]['value']);

        $this->assertEquals('content', $result['fields'][1]['type']);
        $this->assertEquals($subContents[1]->getArrayCopy(), $result['fields'][1]['value']);

        $this->assertEquals('content', $result['fields'][2]['type']);
        $this->assertEquals($subContents[2]->getArrayCopy(), $result['fields'][2]['value']);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(ContentRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->fieldFactory = $this->app->make(ContentContentFieldFactory::class);
    }
}