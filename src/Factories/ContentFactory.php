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
    public function create(array $parameterOverwrites)
    {
        $parameters =
            $parameterOverwrites + [
                $this->contentService->slugify($this->faker->words(rand(2, 6), true)),
                $this->faker->randomElement(
                    [
                        ContentService::STATUS_PUBLISHED,
                        ContentService::STATUS_DRAFT,
                        ContentService::STATUS_ARCHIVED
                    ]
                ),
                'en-US',
                $this->faker->dateTimeThisCentury()
            ];

        ksort($parameters);

        $content = $this->contentService->create(...$parameters);

        return $content;
    }
}