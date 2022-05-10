<?php

namespace App\Decorators\Content;

use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Support\Collection;

class ContentLikesUserDecorator extends ModeDecoratorBase
{
    public function decorate(Collection $contents)
    {
        $userIds = [];

        $contents = $contents->toArray();

        foreach ($contents as $contentLikeIndex => $contentLike) {
            $userIds[] = $contentLike['user_id'];
        }

        $userIds = array_unique($userIds);

        if (empty($userIds)) {
            return new Collection($contents);
        }

        /**
         * @var $users User[]
         */
        $users = User::query()->whereIn('id', $userIds)->get();
        $keyedUsers = [];

        foreach ($users as $userIndex => $user) {
            $keyedUsers[$user->id] = $user;
        }

        foreach ($contents as $contentLikeIndex => $contentLike) {
            if (!isset($keyedUsers[$contentLike['user_id']])) {
                continue;
            }

            $contents[$contentLikeIndex]['display_name'] = $keyedUsers[$contentLike['user_id']]->display_name;
            $contents[$contentLikeIndex]['avatar_url'] = $keyedUsers[$contentLike['user_id']]->profile_picture_url;
        }

        return new Collection($contents);
    }
}
