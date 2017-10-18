<?php

namespace Railroad\Railcontent\Factories;

use Faker\Generator;

abstract class FactoryBase
{
    /**
     * @var Generator
     */
    protected $faker;

    /**
     * FactoryBase constructor.
     */
    public function __construct()
    {
        $this->faker = app(Generator::class);
    }

    /**
     * @param array $attributeOverrides
     * @return mixed
     */
    public abstract function create(array $attributeOverrides = []);
}