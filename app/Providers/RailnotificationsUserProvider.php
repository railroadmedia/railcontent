<?php

namespace App\Providers;

use Modules\UserManagementSystem\Models\FirebaseToken;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railnotifications\Contracts\UserProviderInterface;
use Railroad\Railnotifications\Entities\User as RailnotificationUser;
use Railroad\Railnotifications\Transformers\UserTransformer;

class RailnotificationsUserProvider implements UserProviderInterface
{
    public function getRailnotificationsUserById(int $id): ?RailnotificationUser
    {
        $user = User::query()->where('id', $id)->first();

        if($user) {
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

    public function getRailnotificationsUserId(RailnotificationUser $user): ?int
    {
        return $user->getId();
    }

    public function getUserFirebaseTokens(int $userId, $types = []): ?array
    {
        $tokens = FirebaseToken::whereUserId($userId)->get();

        return $tokens->unique('token')->toArray();
    }

    public function deleteUserFirebaseTokens(int $userId, array $tokens)
    {
        foreach ($tokens as $oldToken) {
            FirebaseToken::whereToken($oldToken)
                ->delete();
        }

        return true;
    }

    public function updateUserFirebaseToken($userId, $oldToken, $newToken)
    {
        FirebaseToken::whereToken($oldToken)->update(['token' => $newToken]);

        return true;
    }

    /**
     * @return TransformerAbstract
     */
    public function getUserTransformer()
    {
        return new UserTransformer();
    }

    public function updateUserNotificationsSummaryFrequency(int $userId, ?string $notificationsSummaryFrequency)
    {
        $user = User::query()->where('id', $userId)->first();

        if($user) {
            $user->notifications_summary_frequency_minutes = $notificationsSummaryFrequency;
            $user->save();
        }

        return $user;
    }
}
