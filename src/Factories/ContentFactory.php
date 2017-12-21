<?php

namespace Railroad\Railcontent\Factories;

use Faker\Generator;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ConfigService;
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
     * @param null $brand
     * @param null $userId
     * @param null $publishedOn
     * @param null $createdOn
     * @return array
     */
    public function create(
        $slug = null,
        $type = null,
        $status = null,
        $language = null,
        $brand = null,
        $userId = null,
        $publishedOn = null,
        $createdOn = null,
        $parentId = null
    ) {
        $this->faker = app(Generator::class);

        $parameters =
            func_get_args() + [
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $this->faker->word,
                $this->faker->randomElement(
                    [
                        ContentService::STATUS_PUBLISHED,
                        ContentService::STATUS_SCHEDULED
                    ]
                ),
                'en-US',
                ConfigService::$brand,
                rand(),
                $this->faker->dateTimeThisCentury(),
                null
            ];

        return parent::create(...$parameters);
    }
}