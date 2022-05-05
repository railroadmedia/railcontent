<?php

namespace Railroad\Railcontent\Factories;

use Faker\Generator;
use Railroad\Railcontent\Services\ContentFieldService;
use Railroad\Railcontent\Services\ElasticService;

class ContentContentFieldFactory extends ContentFieldService
{
    /**
     * @var Generator
     */
    protected $faker;

    protected $elasticService;

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
        $this->elasticService = app(ElasticService::class);

        $data = [
            'content_id' => $contentId ?? rand(),
            'key' => $key ??  $this->faker->randomElement(config('railcontent.contentColumnNamesForFields')),
            'value' => $value ??  $this->faker->word,
            'position' => $position ?? 1,
            'type' => $type ?? 'string',
        ];

        $content = parent::createOrUpdate($data);

        $this->elasticService->syncDocument($content);

        sleep(1);

        return $data;
    }
}