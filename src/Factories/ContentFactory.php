<?php

namespace Railroad\Railcontent\Factories;

use Railroad\Railcontent\Services\ContentService;

class ContentFactory extends FactoryBase
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * ContentFactory constructor.
     *
     * @param ContentService $contentService
     */
    public function __construct(ContentService $contentService)
    {
        parent::__construct();

        $this->contentService = $contentService;
    }

    /**
     * @param array $parameterOverwrites
     * @return array
     */
    public function create(...$parameterOverwrites)
    {
        $parameters = array_merge(
            [
                $this->contentService->slugify($this->faker->words(rand(2, 6), true)),
                $this->faker->randomElement(
                    [
                        ContentService::STATUS_PUBLISHED,
                        ContentService::STATUS_DRAFT,
                        ContentService::STATUS_ARCHIVED
                    ]
                ),
                $this->faker->word,
                rand(),
                'en-US',
                null,
                $this->faker->dateTime()
            ],
            $parameterOverwrites
        );

        return $this->contentService->create(...$parameters);
    }
}