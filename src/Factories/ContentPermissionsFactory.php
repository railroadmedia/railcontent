<?php

namespace Railroad\Railcontent\Factories;

use Faker\Generator;
use Railroad\Railcontent\Services\ContentPermissionService;

class ContentPermissionsFactory extends ContentPermissionService
{
    /**
     * @var Generator
     */
    protected $faker;

    /**
     * @param null $contentId
     * @param null $contentType
     * @param int $permissionId
     * @return array
     */
    public function create($contentId = null, $contentType = null, $permissionId = null)
    {
        $this->faker = app(Generator::class);

        $parameters =
            func_get_args() + [
                rand(),
                $this->faker->word,
                rand(),
            ];

        return parent::create(...$parameters);
    }
}