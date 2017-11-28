<?php

namespace Railroad\Railcontent\Factories;

use Faker\Generator;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\PermissionService;

class PermissionsFactory extends PermissionService
{
    /**
     * @var Generator
     */
    protected $faker;

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

        return parent::create(...$parameters);
    }
}