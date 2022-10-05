<?php

namespace App\Providers;

use DB;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railforums\Contracts\UserProviderInterface;
use Railroad\Railforums\Entities\User as ForumUser;

class RailforumsUserProvider implements UserProviderInterface
{
    private ContentService $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    /**
     * @param $userId
     * @return mixed|string
     */
    public function getUserAccessLevel($userId): string
    {
        return DB::connection(config('user_management_system.database_connection_name'))
                ->table('usora_users')
                ->where('id', $userId)
                ->select(['access_level'])
                ->first()
                ->access_level ?? '';
    }

    /**
     * @param $userId
     * @return ?ForumUser
     */
    public function getUser($userId): ?ForumUser
    {
        if (!empty(user()) && $userId === user()->id) {
            $user = user();
        } else {
            $user = User::query()->find($userId);
        }

        if (!empty($user)) {
            return $this->forumUserFromUserModel($user);
        }

        return null;
    }

    /**
     * @param array $userIds
     * @return array|ForumUser[]
     */
    public function getUsersByIds(array $userIds): array
    {
        $users = User::query()->whereIn('id', $userIds)->get();

        $forumUsers = [];

        foreach ($users as $user) {
            $forumUsers[$user->id] = $this->forumUserFromUserModel($user);
        }

        return $forumUsers;
    }

    /**
     * @param array $userIds
     * @return array
     */
    public function getUsersAccessLevel(array $userIds): array
    {
        $userRows = DB::connection(config('user_management_system.database_connection_name'))
            ->table('usora_users')
            ->whereIn('id', $userIds)
            ->select(['id', 'access_level'])
            ->get();

        $accessLevels = [];

        foreach ($userRows as $userRow) {
            $accessLevels[$userRow->id] =
                $userRow->access_level ?? 'pack';
        }

        return $accessLevels;
    }

    /**
     * @param array $userIds
     * @return array
     */
    public function getUsersXPAndRank(array $userIds): array
    {
        /**
         * @var $users User[]
         */
        $users = User::query()->whereIn('id', $userIds)->get();

        $xp = [];

        foreach ($users as $user) {
            $xp[$user->id]['xp'] = $user->total_xp;
            $xp[$user->id]['xp_rank'] = $user->getXpRank();
            $xp[$user->id]['level_rank'] = $user->getMethodLevel() ?? '1.0';
        }

        return $xp;
    }

    /**
     * @param array $userIds
     * @return array
     */
    public function getAssociatedCoaches(array $userIds): array
    {
        $includedFields = [];
        $associatedUsers = [];

        foreach ($userIds ?? [] as $userId) {
            $includedFields[] = 'associated_user_id,' . $userId;
        }

        $instructors =
            $this->contentService
                ->getFiltered(
                    1,
                    'null',
                    '-published_on',
                    ['instructor'],
                    [],
                    [],
                    [],
                    $includedFields
                );

        foreach ($instructors->results() as $instructor) {
            $associatedUsers[$instructor->fetch('fields.associated_user_id')] = [
                'id' => $instructor['id'],
                'url' => $instructor->fetch('url', ''),
                'is_house_coach' => $instructor->fetch('fields.is_house_coach', 0),
            ];
        }

        return $associatedUsers;
    }

    /**
     * @param User $userModel
     * @return ForumUser
     */
    private function forumUserFromUserModel(User $userModel)
    {

        return new ForumUser(
            $userModel->id,
            $userModel->display_name,
            $userModel->profile_picture_url,
            $userModel->created_at,
            $userModel->timezone ?? '',
            $userModel->getAttributes()['total_xp'] ?? 0,
            $userModel->getXpRank(),
            $userModel->getMethodLevel(),
           $userModel->getAttributes()['access_level'] ?? ''
        );
    }
}
