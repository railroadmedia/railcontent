<?php

namespace App\Providers;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use League\Fractal\TransformerAbstract;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Models\User;
use Railroad\DoctrineArrayHydrator\Contracts\UserProviderInterface as ArrayHydratorUserProviderInterface;
use Railroad\Ecommerce\Contracts\UserProviderInterface;
use Railroad\Ecommerce\Entities\Product;
use Railroad\Ecommerce\Entities\User as EcommerceUser;
use Railroad\Ecommerce\Services\UserProductService;
use Railroad\Ecommerce\Transformers\UserTransformer;

class EcommerceUserProvider implements UserProviderInterface, ArrayHydratorUserProviderInterface
{
    const RESOURCE_TYPE = 'user';

    /**
     * @var UserProductService
     */
    private $userProductService;

    /**
     * @var array
     */
    private $brandsUserIsAMemberOfCache = [];

    /**
     * @var Inflector
     */
    private $inflector;

    /**
     * EcommerceUserProvider constructor.
     */
    public function __construct(UserProductService $userProductService)
    {
        $this->userProductService = $userProductService;
        $this->inflector = InflectorFactory::create()->build();
    }

    /**
     * @param  int  $id
     * @return EcommerceUser|null
     */
    public function getUserById(int $id): ?EcommerceUser
    {
        $user = User::query()->find($id);

        if ($user) {
            return new EcommerceUser($user->getId(), $user->getEmail());
        }

        return null;
    }

    /**
     * @param  array  $ids
     * @return array
     */
    public function getUsersByIds(array $ids): array
    {
        return User::query()->whereIn('id', $ids)->get()->toArray();
    }

    /**
     * @param  EcommerceUser  $user
     * @return int
     */
    public function getUserId(EcommerceUser $user): int
    {
        return $user->getId();
    }

    /**
     * @return User|null
     */
    public function getCurrentUser(): ?EcommerceUser
    {
        if (!user()) {
            return null;
        }

        return user();
    }

    /**
     * @return int|null
     */
    public function getCurrentUserId(): ?int
    {
        return user()->id;
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
     * @param  string  $relationName
     * @param  array  $data
     */
    public function hydrateTransDomain($entity, string $relationName, array $data): void
    {
        $setterName = $this->inflector->camelize('set'.ucwords($relationName));

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
     * @param  string  $resourceType
     * @return bool
     */
    public function isTransient(string $resourceType): bool
    {
        return $resourceType !== self::RESOURCE_TYPE;
    }

    /**
     * @param  string  $email
     * @param  string  $password
     * @return User|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function createUser(string $email, string $password): ?EcommerceUser
    {
        $parts = explode('@', $email);

        $user = new User(['email' => $email, 'display_name' => $parts[0].rand(10000, 99999), 'password' => $password]);

        event(new UserCreated($user));

        return new EcommerceUser($user->id, $user->email);
    }

    /**
     * @param  string  $email
     *
     * @return bool
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function checkEmailExists(string $email): bool
    {
        return User::query()->where('email', $email)->count() > 0;
    }

    /**
     * @param  string  $email
     * @param  string  $password
     *
     * @return bool
     */
    public function checkCredentials(string $email, string $password): bool
    {
        return auth()->validate(['email' => $email, 'password' => $password]);
    }

    /**
     * @param  EcommerceUser  $user
     * @return string
     */
    public function getUserAuthToken(EcommerceUser $user): string
    {
        $user = User::query()->find($user->getId());

        return $user->currentAccessToken();
    }

    /**
     * @param  string  $email
     * @return EcommerceUser|null
     */
    public function getUserByEmail(string $email): ?EcommerceUser
    {
        $user = User::query()->where('email', $email)->first();

        if ($user) {
            return new EcommerceUser($user->getId(), $user->getEmail());
        }

        return null;
    }

    /**
     * Returns a list of brands that the user is currently a member of.
     *
     * @param  integer  $userId
     * @return array
     */
    public function getBrandsUserIsAMemberOf($userId)
    {
        if (isset($this->brandsUserIsAMemberOfCache[$userId])) {
            return $this->brandsUserIsAMemberOfCache[$userId];
        }

        $allUsersProducts = $this->userProductService->getAllUsersProducts($userId);

        $memberBrands = [];

        foreach ($allUsersProducts as $allUsersProduct) {
            if ($allUsersProduct->isValid() &&
                in_array(
                    $allUsersProduct->getProduct()->getType(),
                    [Product::TYPE_DIGITAL_ONE_TIME, Product::TYPE_DIGITAL_SUBSCRIPTION]
                )) {
                $memberBrands[] = $allUsersProduct->getProduct()->getBrand();
            }
        }

        $memberBrands = array_unique($memberBrands);

        $this->brandsUserIsAMemberOfCache[$userId] = $memberBrands;

        return $memberBrands;
    }
}
