<?php

namespace Railroad\Railcontent\Factories;

use Faker\Generator;
use Railroad\Railcontent\Services\ContentFieldService;

class ContentContentFieldFactory extends ContentFieldService
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
     * @param null $type
     * @return array
     */
    public function create($contentId = null, $key = null, $value = null, $position = null, $type = null)
    {
        $this->faker = app(Generator::class);

        $data = [
            'content_id' => $contentId ?? rand(),
            'key' => $key ??  $this->faker->word,
            'value' => $value ??  $this->faker->word,
            'position' => $position ?? rand(),
            'type' => $type ?? $this->faker->word,
        ];

        return parent::createOrUpdate($data);
    }
}