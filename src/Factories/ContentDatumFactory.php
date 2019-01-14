<?php

namespace Railroad\Railcontent\Factories;

use Doctrine\ORM\EntityManager;
use Faker\Generator;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentData;


class ContentDatumFactory
{
    /**
     * @var Generator
     */
    protected $faker;

    protected $entityManager;

    /**
     * ContentDatumFactory constructor.
     *
     * @param $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

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

        if($contentId) {
            $content =
                $this->entityManager->getRepository(Content::class)
                    ->find($contentId);
        } else {

            $content = new ContentFactory($this->entityManager);
            $content = $content->create();
        }

        $parameters =
            func_get_args() + [
                rand(),
                $this->faker->word,
                $this->faker->word,
                rand(),
                $this->faker->word
            ];

        $data = new ContentData();
        $data->setKey($parameters[1]);
        $data->setValue($parameters[2]);
        $data->setPosition($parameters[3]);
        $data->setContent($content);

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }
}