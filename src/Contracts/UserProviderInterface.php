<?php

namespace Railroad\Railcontent\Contracts;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\User;
use Railroad\Usora\Entities\UserTopics;

interface UserProviderInterface
{
    /**
     * @param int $id
     * @return User|null
     */
    public function getRailcontentUserById(int $id): ?User;

    /**
     * @param User $user
     * @return int
     */
    public function getUserId($user): int;

    /**
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User;

    /**
     * @param User $user
     * @return int
     */
    public function getRailcontentUserId(User $user): int;
    /**
     * @param array $ids
     * @return User[]
     */
    public function getUsersByIds(array $ids): array;

    /**
     * @param int $id
     * @param string $brand
     * @return array
     */
    public function getUserByLegacyId(int $id, string $brand): ?User;

    /**
     * @return User|null
     */
    public function getRailcontentCurrentUser(): ?User;

    /**
     * @return User|null
     */
    public function getCurrentUser(): ?User;

    /**
     * @return int|null
     */
    public function getCurrentUserId(): ?int;

    /**
     * @return TransformerAbstract
     */
    public function getUserTransformer(): TransformerAbstract;

    /**
     * @param string $email
     * @param string $password
     * @return User|null
     */
    public function createRailcontentUser(string $email, string $password): ?User;

    /**
     * @return array|null
     */
    public function getCurrentUserTopics(): ?array;

    /**
     * @param array $topic
     * @return array|null
     */
    public function createCurrentUserTopics(array  $topic): ?array ;

    /**
     * @return mixed
     */
    public function deleteCurrentUserTopics();

    /**
     * @param $difficulty
     * @return mixed
     */
    public function updateCurrentUserDifficulty($difficulty);
}
