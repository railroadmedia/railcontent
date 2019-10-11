<?php

namespace Railroad\Railcontent\Tests\Fixtures;

use Doctrine\Common\Inflector\Inflector;
use Illuminate\Support\Facades\DB;
use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Contracts\UserProviderInterface;

class UserProvider implements
    UserProviderInterface
{
    CONST RESOURCE_TYPE = 'user';

    public function getRailcontentUserById(int $id): ?\Railroad\Railcontent\Entities\User
    {
        $user = DB::table('users')->find($id);

        if ($user) {
            return new \Railroad\Railcontent\Entities\User($id, $user->email, $user->display_name, $user->profile_picture_url);
        }

        return null;
    }

    public function getRailcontentUserId(\Railroad\Railcontent\Entities\User $user): int
    {
        return $user->getId();
    }

    public function getRailcontentCurrentUser(): ?\Railroad\Railcontent\Entities\User
    {
        if (!auth()->id()) {
            return null;
        }

        return $this->getRailcontentUserById(auth()->id());
    }

    public function getCurrentUserId(): ?int
    {
        return auth()->id();
    }

    public function getUserTransformer(): TransformerAbstract
    {
        return new UserTransformer();
    }

    public function isTransient(string $resourceType): bool {

        return $resourceType !== self::RESOURCE_TYPE;
    }

    public function hydrateTransDomain(
        $entity,
        string $relationName,
        array $data
    ): void {

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

    public function createRailcontentUser(
        string $email,
        string $password
    ): ?\Railroad\Railcontent\Entities\User {

        $userId = DB::table('users')
            ->insertGetId([
                'email' => $email,
                'password' => $password,
                'display_name' => $email,
            ]);

        return $this->getRailcontentUserById($userId);
    }

    public function getUserByLegacyId(int $id, string $brand): array
    {
        $user = DB::table('users')->where('legacy_id',$id)->where('brand',$brand)->first();

        if ($user) {
            return new \Railroad\Railcontent\Entities\User($id, $user->email);
        }

        return null;
    }

    public function getUsersByIds(array $ids)
    : array {
        // TODO: Implement getUsersByIds() method.
    }
}
