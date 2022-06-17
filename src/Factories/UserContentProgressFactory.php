<?php

namespace Railroad\Railcontent\Factories;

use Faker\Generator;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ElasticService;
use Railroad\Railcontent\Services\UserContentProgressService;

class UserContentProgressFactory extends UserContentProgressService
{
    /**
     * @var Generator
     */
    protected $faker;

    protected $contentService;

    /**
     * @param int|null $contentId
     * @param int|null $userId
     * @return bool
     */
    public function startContent($contentId = null, $userId = null, $forceEvenIfComplete = false)
    {
        $this->faker = app(Generator::class);
        $this->elasticService = app(ElasticService::class);
        $this->contentService = app(ContentService::class);


        $parameters =
            func_get_args() + [
                $this->faker->randomNumber(),
                $this->faker->randomNumber(),
                false
            ];

        $userContentId = parent::startContent(...$parameters);

        $content = $this->contentService->getById($parameters[0]);

        return $userContentId;
    }

    /**
     * @param int|null $contentId
     * @param int|null $userId
     * @return bool
     */
    public function completeContent($contentId = null, $userId = null)
    {
        $this->faker = app(Generator::class);

        $parameters =
            func_get_args() + [
                $this->faker->randomNumber(),
                $this->faker->randomNumber(),
            ];

        $userContentId = parent::completeContent(...$parameters);

        return $userContentId;
    }

    /**
     * @param int|null $contentId
     * @param int|null $progress
     * @param int|null $userId
     * @return bool
     */
    public function saveContentProgress($contentId = null, $progress = null, $userId = null, $overwriteComplete = false)
    {
        $this->faker = app(Generator::class);

        $parameters =
            func_get_args() + [
                $this->faker->randomNumber(),
                $this->faker->numberBetween(0, 99),
                $this->faker->randomNumber(),
            ];

        $userContentId = parent::saveContentProgress(...$parameters);


        return $userContentId;
    }
}
