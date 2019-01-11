<?php

namespace Railroad\Railcontent\Factories;

use Doctrine\ORM\EntityManager;
use Faker\Factory;
use Faker\Generator;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentField;
use Railroad\Railcontent\Services\ContentFieldService;

class ContentContentFieldFactory
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

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

        $field = new ContentField();
        $field->setKey($parameters[1]);
        $field->setValue($parameters[2]);
        $field->setPosition($parameters[3]);
        $field->setType($parameters[4]);
        $field->setContent($content);

        $this->entityManager->persist($field);
        $this->entityManager->flush();

        return $field;
    }
}