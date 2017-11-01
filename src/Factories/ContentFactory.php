<?php

namespace Railroad\Railcontent\Factories;

use Faker\Generator;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ContentService;

class ContentFactory extends ContentService
{
    /**
     * @var Generator
     */
    protected $faker;

    /**
     * @param null $slug
     * @param null $type
     * @param null $status
     * @param null $language
     * @param null $publishedOn
     * @param null $createdOn
     * @return array
     */
    public function create(
        $slug = null,
        $type = null,
        $status = null,
        $language = null,
        $publishedOn = null,
        $createdOn = null
    ) {
        $this->faker = app(Generator::class);

        $parameters =
            func_get_args() + [
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $this->faker->word,
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

        return parent::create(...$parameters);
    }
}