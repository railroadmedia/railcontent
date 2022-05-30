<?php

namespace App\Providers;

use DB;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railforums\Contracts\UserProviderInterface;
use Railroad\Usora\Repositories\UserRepository;

class RailforumsUserProvider implements UserProviderInterface
{
    private UserRepository $userRepository;
    private ContentService $contentService;

    public function __construct(UserRepository $userRepository, ContentService $contentService)
    {
        $this->userRepository = $userRepository;
        $this->contentService = $contentService;
    }

    /**
     * @return mixed|\Railroad\Usora\Entities\User|null
     */
    public function getCurrentUser()
    {
        if (!auth()->id()) {
            return null;
        }

        return $this->userRepository->find(auth()->id());
    }

    /**
     * @param $userId
     * @return mixed|string
     */
    public function getUserAccessLevel($userId)
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
     * @return \Railroad\Usora\Entities\User
     */
    public function getUser($userId)
    {
        return $this->userRepository->find($userId);
    }

    /**
     * @param array $userIds
     * @return array|\Railroad\Usora\Entities\User[]
     */
    public function getUsersByIds(array $userIds): array
    {
        return $this->userRepository->findByIds($userIds);
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
            $xp[$user->id]['xp_rank'] = map_experience_rank($user->total_xp);
            $xp[$user->id]['level_rank'] = (array)$user->brand_method_levels[brand()] ?? '1.0';
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
}
