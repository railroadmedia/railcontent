<?php

namespace App\Providers;

use Modules\UserManagementSystem\Models\FirebaseToken;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railnotifications\Contracts\UserProviderInterface;
use Railroad\Railnotifications\Entities\User as RailnotificationUser;
use Railroad\Railnotifications\Transformers\UserTransformer;

class RailnotificationsUserProvider implements UserProviderInterface
{

    public function getRailnotificationsUserById(int $id)
    : ?RailnotificationUser {
        $user = User::query()->where('id', $id)->first();

        if($user){
            return new RailnotificationUser(
                $user->id,
                $user->email,
                $user->display_name,
                $user->profile_picture_url,
                $user->notifications_summary_frequency_minutes
            );
        }

        return $user;
    }

    public function getRailnotificationsUserId(RailnotificationUser $user)
    : ?int {
        return $user->getId();
    }

    public function getUserFirebaseTokens(int $userId, $types = [])
    : ?array {
        $tokens = FirebaseToken::whereUserId($userId)->get()->toArray();

        return $tokens;
    }

    public function deleteUserFirebaseTokens(int $userId, array $tokens)
    {
        // TODO: Implement deleteUserFirebaseTokens() method.
    }

    public function updateUserFirebaseToken($userId, $oldToken, $newToken)
    {
        // TODO: Implement updateUserFirebaseToken() method.
    }

    /**
     * @return TransformerAbstract
     */
    public function getUserTransformer()
    {
        return new UserTransformer();
    }
}
