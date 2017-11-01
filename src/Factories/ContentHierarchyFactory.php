<?php

namespace Railroad\Railcontent\Factories;

use Faker\Generator;
use Railroad\Railcontent\Services\ContentHierarchyService;

class ContentHierarchyFactory extends ContentHierarchyService
{
    /**
     * @var Generator
     */
    protected $faker;

    /**
     * @param null $parentId
     * @param null $childId
     * @param null $childPosition
     * @return void
     */
    public function create($parentId = null, $childId = null, $childPosition = null)
    {
        $this->faker = app(Generator::class);

        $parameters =
            func_get_args() + [
                rand(),
                rand(),
                rand(),
            ];

        parent::create(...$parameters);
    }
}