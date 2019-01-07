<?php

namespace Railroad\Railcontent\Factories;

use Carbon\Carbon;
use Doctrine\ORM\EntityManager;
use Faker\Generator;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class ContentFactory
{
    /**
     * @var Generator
     */
    protected $faker;

    protected $entityManager;

    /**
     * ContentFactory constructor.
     *
     * @param $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

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
                $this->faker->dateTimeThisCentury()
            ];

        $content = new Content();
        $content->setSlug($parameters[0]);
        $content->setType($parameters[1]);
        $content->setStatus($parameters[2]);
        $content->setLanguage($parameters[3]);
        $content->setBrand($parameters[4]);
        $content->setSort($parameters[5]);

        $this->entityManager->persist($content);
        $this->entityManager->flush();

        return $content;
    }
}