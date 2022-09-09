<?php

namespace App\Modules\EventDataSynchronizer\Tests\Fixtures;

use Doctrine\Inflector\Inflector;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use League\Fractal\TransformerAbstract;
use Railroad\DoctrineArrayHydrator\Contracts\UserProviderInterface as ArrayHydratorUserProviderInterface;
use Railroad\Ecommerce\Contracts\UserProviderInterface;
use Railroad\Ecommerce\Entities\User;
use Railroad\Ecommerce\Transformers\UserTransformer;
use Modules\UserManagementSystem\Models\User as UsoraUser;
use Modules\UserManagementSystem\Events\User\UserCreated;
use App\Modules\UserManagementSystem\Services\UserService;

use function app;
use function auth;
use function event;

class TestingEcommerceUserProvider implements UserProviderInterface, ArrayHydratorUserProviderInterface
{
    CONST RESOURCE_TYPE = 'user';

    private UserService $userService;
    private Inflector $inflector;

    /**
     * EcommerceUserProvider constructor.
     *
     * @param UserService $userService
     */
    public function __construct(
        UserService $userService
    )
    {
        $this->userService = $userService;
        $this->inflector = app('DoctrineInflector');
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User
    {
        $usoraUser = $this->userService->getByEmailOrNull($id);

        if ($usoraUser) {
            return new User($usorauser->id, $usoraUser->email);
        }

        return null;
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getUsersByIds(array $ids): array
    {
        return $this->userService->getUsersByIds($ids);
    }

    /**
     * @param User $user
     * @return int
     */
    public function getUserId(User $user): int
    {
        return $user->id;
    }

    /**
     * @return User|null
     */
    public function getCurrentUser(): ?User
    {
        if (!auth()->id()) {
            return null;
        }

        return $this->getUserById(auth()->id());
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
     * @param $entity
     * @param string $relationName
     * @param array $data
     */
    public function hydrateTransDomain($entity, string $relationName, array $data): void
    {
        $setterName = $this->inflector->camelize('set' . ucwords($relationName));

        if (isset($data['data']['type']) &&
            $data['data']['type'] === self::RESOURCE_TYPE &&
            isset($data['data']['id']) &&
            is_object($entity) &&
            method_exists($entity, $setterName)) {

            $user = $this->getUserById($data['data']['id']);

            call_user_func([$entity, $setterName], $user);
        }

        // else some exception should be thrown
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
     * @param string $email
     * @param string $password
     * @return User|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function createUser(string $email, string $password): ?User
    {
        $usoraUser = new UsoraUser();

        $usoraUser->setEmail($email);
        $parts = explode('@', $email);
        $usoraUser->setDisplayName($parts[0] . rand(10000, 99999));
        $usoraUser->setPassword($password);

        $usoraUser->save();

        event(new UserCreated($usoraUser));

        return new User($usorauser->id, $usoraUser->email);
    }

    /**
     * @param string $email
     *
     * @return bool
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function checkEmailExists(string $email): bool
    {
        $user = $this->userService->getByEmailOrNull($email);

        return ($user != null);
    }

    /**
     * @param User $user
     * @return string
     */
    public function getUserAuthToken(User $user): string
    {
        return '';
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User
    {
        $usoraUser = $this->userService->getByEmailOrNull($email);

        if ($usoraUser) {
            return new User($usorauser->id, $usoraUser->email);
        }

        return null;
    }

    public function checkCredentials(string $email, string $password): bool
    {
        // TODO: Implement checkCredentials() method.
    }

    public function getBrandsUserIsAMemberOf($userId)
    {
        return [];
    }
}
