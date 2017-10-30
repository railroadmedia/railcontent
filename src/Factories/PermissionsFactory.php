<?php

namespace Railroad\Railcontent\Factories;

use Railroad\Railcontent\Services\PermissionService;

class PermissionsFactory extends FactoryBase
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
                $this->faker->word,
            ];

        ksort($parameters);

        $content = $this->permissionService->store(...$parameters);

        return $content;
    }
}