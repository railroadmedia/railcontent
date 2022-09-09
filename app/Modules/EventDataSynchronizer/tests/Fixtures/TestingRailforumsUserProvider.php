<?php

namespace App\Modules\EventDataSynchronizer\Tests\Fixtures;

use Railroad\Railforums\Contracts\UserProviderInterface;
use Modules\UserManagementSystem\Models\User;

class TestingRailforumsUserProvider implements UserProviderInterface
{
    /**
     * @return mixed|User|null
     */
    public function getCurrentUser()
    {
        return null;
    }

    /**
     * @param $userId
     * @return mixed|string
     */
    public function getUserAccessLevel($userId): string
    {
        return '';
    }

    /**
     * @param $userId
     * @return User
     */
    public function getUser($userId)
    {
        return null;
    }

    /**
     * @param array $userIds
     * @return array|User[]
     */
    public function getUsersByIds(array $userIds): array
    {
        return [];
    }

    /**
     * @param array $userIds
     * @return array
     */
    public function getUsersAccessLevel(array $userIds): array
    {
        return [];
    }

    /**
     * @param array $userIds
     * @return array
     */
    public function getUsersXPAndRank(array $userIds): array
    {
        return [];
    }

    /**
     * @param array $userIds
     * @return array
     */
    public function getAssociatedCoaches(array $userIds): array
    {
        return [];
    }
}
