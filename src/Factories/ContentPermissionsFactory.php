<?php

namespace Railroad\Railcontent\Factories;

use Railroad\Railcontent\Services\PermissionService;

class ContentPermissionsFactory extends FactoryBase
{
    /**
     * @var PermissionService
     */
    private $permissionService;

    /**
     * ContentFactory constructor.
     *
     * @param PermissionService $permissionService
     */
    public function __construct(PermissionService $permissionService)
    {
        parent::__construct();

        $this->permissionService = $permissionService;
    }

    /**
     * @param array $parameterOverwrites
     * @return array
     */
    public function create(array $parameterOverwrites = [])
    {
        $parameters =
            $parameterOverwrites + [
                $this->faker->randomNumber(),
                $this->faker->randomNumber(),
                $this->faker->boolean() ? $this->faker->word : null,
            ];

        ksort($parameters);

        $content = $this->permissionService->assign(...$parameters);

        return $content;
    }
}