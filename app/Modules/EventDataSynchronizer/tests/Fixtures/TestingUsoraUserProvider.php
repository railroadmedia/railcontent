<?php

namespace App\Modules\EventDataSynchronizer\Tests\Fixtures;

use Railroad\DoctrineArrayHydrator\Contracts\UserProviderInterface;
use App\Modules\UserManagementSystem\Services\UserService;

class TestingUsoraUserProvider implements UserProviderInterface
{
    CONST RESOURCE_TYPE = 'user';

    /**
     * @var UserService
     */
    private $userService;

    /**
     * UsoraTestingUserProvider constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param $entity
     * @param string $relationName
     * @param array $data
     */
    public function hydrateTransDomain($entity, string $relationName, array $data): void
    {
        $setterName = app('DoctrineInflector')->camelize('set' . ucwords($relationName));

        if (isset($data['data']['type']) &&
            $data['data']['type'] === self::RESOURCE_TYPE &&
            isset($data['data']['id']) &&
            is_object($entity) &&
            method_exists($entity, $setterName)) {

            $user = $this->userService->getByEmailOrNull($data['data']['id']);

            call_user_func([$entity, $setterName], $user);
        }
    }

    /**
     * @param string $resourceType
     * @return bool
     */
    public function isTransient(string $resourceType): bool
    {
        return $resourceType !== self::RESOURCE_TYPE;
    }
}
