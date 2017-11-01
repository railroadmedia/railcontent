<?php

namespace Railroad\Railcontent\Factories;

use Faker\Generator;
use Railroad\Railcontent\Services\ContentDatumService;

class ContentDatumFactory extends ContentDatumService
{
    /**
     * @var Generator
     */
    protected $faker;

    /**
     * @param null $contentId
     * @param null $key
     * @param null $value
     * @param null $position
     * @return array
     */
    public function create($contentId = null, $key = null, $value = null, $position = null)
    {
        $this->faker = app(Generator::class);

        $parameters =
            func_get_args() + [
                rand(),
                $this->faker->word,
                $this->faker->word,
                rand()
            ];

        return parent::create(...$parameters);
    }
}