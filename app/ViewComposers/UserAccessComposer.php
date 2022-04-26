<?php

namespace App\ViewComposers;

use App\Services\User\UserAccessService;
use App\Services\User\UserContentProgressService;
use Illuminate\View\View;
use Railroad\Points\Services\UserPointsService;

class UserAccessComposer
{
    /**
     * Check the users permission levels and render a different nav for different levels
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $viewName = $view->getName();
        $member = current_user();

        if (!empty($view->getData()['user']) && $view->getData()['user'] != $member) {
            $member = $view->getData()['user'];
        }

        $accessLevel = 'edge';

        if (!UserAccessService::isEdge($member->getId())) {
            $accessLevel = 'pack';
        }

        if (UserAccessService::isEdgeLifetime($member->getId())) {
            $accessLevel = 'lifetime';
        }

        if (UserAccessService::isAdministrator($member->getId())) {
            $accessLevel = 'team';
        }

        if (UserAccessService::isCoach($member->getId())) {
            $accessLevel = 'coach';
        }

        $userXP = UserPointsService::fetchPoints($member->getId());
        $xpRank = map_experience_rank($userXP);

        $currentUser = [
            "avatar" => $member->getProfilePictureUrl(),
            "xp" => $userXP,
            "access_level" => $accessLevel,
            "xp_rank" => $xpRank,
            "level_number" =>  UserContentProgressService::getLevelRank($member->getId())
        ];

        $view->with([
            'currentUser' => $currentUser,
            "profileUrl" => url()->route('user.dashboard', ["id" => current_user()->getId()]),
            'brand' => 'drumeo'
        ]);
    }
}
