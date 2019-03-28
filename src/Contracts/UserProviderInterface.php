<?php

namespace Railroad\Railcontent\Contracts;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\User;

interface UserProviderInterface
{
    public function getUserById(int $id): ?User;

    public function getUserId(User $user): int;

    public function getCurrentUser(): ?User;

    public function getCurrentUserId(): ?int;

    public function getUserTransformer(): TransformerAbstract;

    public function createUser(string $email, string $password): ?User;
}
