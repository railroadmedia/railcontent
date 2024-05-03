<?php

namespace App\Modules\FeatureFlagging\Contracts;

use Modules\UserManagementSystem\Models\User;

interface FeatureFlagsContract
{
    /**
     * @param string $featureName - Name of the feature to test
     * @param User|null $user - Authorized user, or null. If null, the manager will attempt to get the authorized user
     * @return bool -
     */
    public function accessible(string $featureName, User $user = null): bool;

    /**
     * @param string $experimentName - Name of the experiment to get a branch from
     * @param User|null $user - Authorized user, or null. If null, the manager will attempt to get the authorized user
     * @return string - selected branch contents or default experiment value
     */
    public function branch(string $experimentName, User $user = null): string;

    /**
     * @param User $user - Authorized user
     * @return array - array of all branches in the form of experimentName => branchContent
     */
    public function allBranches(User $user): array;

    /**
     * @param User $user - Authorized user
     * @return array - array of all accessible featureNames for the provided user
     */
    public function allowedFeatures(User $user): array;


}
