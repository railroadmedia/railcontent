<?php

namespace Railroad\Railcontent\Factories;

use Faker\Generator;
use Railroad\Railcontent\Services\PermissionService;

class PermissionsFactory extends PermissionService
{
    /**
     * @var Generator
     */
    protected $faker;

    /**
     * @param null $name
     * @return array
     */
    public function create($name = null)
    {
        $this->faker = app(Generator::class);

        $parameters =
            func_get_args() + [
                $this->faker->word,
            ];

        return parent::create(...$parameters);
    }
}