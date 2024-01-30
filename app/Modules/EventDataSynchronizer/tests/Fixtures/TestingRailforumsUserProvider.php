<?php

namespace App\Modules\EventDataSynchronizer\tests\Fixtures;

use Railroad\Railforums\Contracts\UserProviderInterface;
use Railroad\Railforums\Entities\User;

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

    public function getUser($userId): ?\Railroad\Railforums\Entities\User
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getBlockedUsers(): ?array
    {
        // TODO: Implement getBlockedUsers() method.
    }
}
