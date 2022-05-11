<?php

namespace App\Decorators\Content;

use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Support\Collection;

class ContentCommentLikesUserDecorator extends ModeDecoratorBase
{
    public function decorate(Collection $content)
    {
        $userIds = [];

        foreach ($content as $likeIndex => $like) {
            $userIds[] = $like['user_id'];
        }

        $userIds = array_unique($userIds);

        /**
         * @var $users User[]
         */
        $users = User::query()->whereIn('id', $userIds)->get();

        $keyedUsers = [];

        foreach ($users as $userIndex => $user) {
            $keyedUsers[$user->id] = $user;
        }

        foreach ($content as $likeIndex => $like) {
            if (!isset($keyedUsers[$like['user_id']])) {
                continue;
            }

            $content[$likeIndex] = array_merge(
                [
                    'display_name' => $keyedUsers[$like['user_id']]->display_name,
                    'avatar_url' => $keyedUsers[$like['user_id']]->profile_picture_url,
                    'xp' => $keyedUsers[$like['user_id']]->total_xp,
                    'access_level' => $keyedUsers[$like['user_id']]->access_level,
                ],
                $content[$likeIndex]
            );
        }

        return $content;
    }
}
