<?php

namespace Railroad\Railcontent\Tests\Fixtures;

use Doctrine\Common\Inflector\Inflector;
use Illuminate\Support\Facades\DB;
use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\User;

class UserProvider implements UserProviderInterface
{
    const RESOURCE_TYPE = 'user';

    /**
     * @param int $id
     * @return User|null
     */
    public function getRailcontentUserById(int $id): ?User
    {
        $user = DB::table('users')->find($id);

        if ($user) {
            return new User(
                $id,
                $user->email,
                $user->display_name,
                $user->profile_picture_url
            );
        }

        return null;
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User
    {
        $user = DB::table('users')->find($id);

        if ($user) {
            return new User(
                $id,
                $user->email,
                $user->display_name,
                $user->profile_picture_url
            );
        }

        return null;
    }

    /**
     * @param User $user
     * @return int
     */
    public function getRailcontentUserId(User $user): int
    {
        return $user->getId();
    }

    /**
     * @param User $user
     * @return int
     */
    public function getUserId($user): int
    {
        return $user->getId();
    }

    /**
     * @return User|null
     */
    public function getRailcontentCurrentUser(): ?User
    {
        if (!auth()->id()) {
            return null;
        }

        return $this->getRailcontentUserById(auth()->id());
    }


    /**
     * @return User|null
     */
    public function getCurrentUser(): ?User
    {
        if (!auth()->id()) {
            return null;
        }

        return $this->getRailcontentUserById(auth()->id());
    }

    /**
     * @return int|null
     */
    public function getCurrentUserId(): ?int
    {
        return auth()->id();
    }

    /**
     * @return TransformerAbstract
     */
    public function getUserTransformer(): TransformerAbstract
    {
        return new UserTransformer();
    }

    /**
     * @param string $resourceType
     * @return bool
     */
    public function isTransient(string $resourceType): bool
    {

        return $resourceType !== self::RESOURCE_TYPE;
    }

    /**
     * @param $entity
     * @param string $relationName
     * @param array $data
     */
    public function hydrateTransDomain(
        $entity,
        string $relationName,
        array $data
    ): void
    {

        $setterName = Inflector::camelize('set' . ucwords($relationName));

        if (
            isset($data['data']['type']) &&
            $data['data']['type'] === self::RESOURCE_TYPE &&
            isset($data['data']['id']) &&
            is_object($entity) &&
            method_exists($entity, $setterName)
        ) {

            $user = $this->getRailcontentUserById($data['data']['id']);

            call_user_func([$entity, $setterName], $user);
        }

        // else some exception should be thrown
    }

    /**
     * @param string $email
     * @param string $password
     * @return User|null
     */
    public function createRailcontentUser(
        string $email,
        string $password
    ): ?User
    {

        $userId = DB::table('users')
            ->insertGetId(
                [
                    'email' => $email,
                    'password' => $password,
                    'display_name' => $email,
                ]
            );

        return $this->getRailcontentUserById($userId);
    }

    /**
     * @param int $id
     * @param string $brand
     * @return User|null
     */
    public function getUserByLegacyId(int $id, string $brand): ?User
    {
        $user = DB::table('users')->where('legacy_id', $id)->where('brand', $brand)->first();

        if ($user) {
            return new User($id, $user->email, $user->display_name, $user->profile_picture_url);
        }

        return null;
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getUsersByIds(array $ids): array
    {
        // TODO: Implement getUsersByIds() method.
    }

    public function getCurrentUserTopics(): ?array
    {
        // TODO: Implement getCurrentUserTopics() method.
        return [];
    }

    public function createCurrentUserTopics(array $topic)
    : ?array {
        // TODO: Implement createCurrentUserTopics() method.
        return [];
    }

    public function deleteCurrentUserTopics()
    {
        // TODO: Implement deleteCurrentUserTopics() method.
    }

    public function updateCurrentUserDifficulty($difficulty)
    {
        // TODO: Implement updateCurrentUserDifficulty() method.
    }
}
