<?php

namespace Railroad\Railcontent\Factories;

use Doctrine\ORM\EntityManager;
use Faker\Generator;
use Railroad\Railcontent\Entities\Permission;
use Railroad\Railcontent\Services\ConfigService;

class PermissionsFactory
{
    /**
     * @var Generator
     */
    protected $faker;

    protected $entityManager;

    /**
     * PermissionsFactory constructor.
     *
     * @param $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param null $name
     * @param null $brand
     * @return array
     */
    public function create($name = null, $brand = null)
    {
        $this->faker = app(Generator::class);

        $parameters =
            func_get_args() + [
                $this->faker->word,
                ConfigService::$brand,
            ];

        $permission = new Permission();
        $permission->setName($parameters[0]);
        $permission->setBrand($parameters[1]);

        $this->entityManager->persist($permission);
        $this->entityManager->flush();

        return $permission;
    }
}