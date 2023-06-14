<?php

namespace App\Decorators\Comments;

use App\Decorators\Content\ModeDecoratorBase;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Support\Collection;

class CommentLikesUserDecorator extends ModeDecoratorBase
{
    public function decorate(Collection $content)
    {
        $userIds = [];
        if ($content->isEmpty()) {
            return $content;
        }

        foreach ($content as $commentIndex => $comment) {
            $userIds = array_merge($userIds, $comment['like_users'] ?? []);

            foreach ($comment['replies'] ?? [] as $replyIndex => $reply) {
                $userIds = array_merge($userIds, $reply['like_users'] ?? []);
            }
        }

        $userIds = array_unique($userIds);

        /**
         * @var $users User[]
         */
        $users =
            User::query()
                ->whereIn('id', $userIds)
                ->get();
        $keyedUsers = [];

        foreach ($users as $userIndex => $user) {
            $keyedUsers[$user->id] = $user;
        }

        foreach ($content as $commentIndex => $comment) {
            foreach ($comment['like_users'] as $userLikeIndex => $userLikerId) {
                if (!isset($keyedUsers[$userLikerId])) {
                    continue;
                }

                $content[$commentIndex]['like_users'][$userLikeIndex] = [
                    'id' => $userLikerId,
                    'display_name' => $keyedUsers[$userLikerId]->display_name,
                    'avatar_url' => $keyedUsers[$userLikerId]->profile_picture_url,
                ];
            }

            foreach ($comment['replies'] ?? [] as $replyIndex => $reply) {
                foreach ($reply['like_users'] as $userLikeIndex => $userLikerId) {
                    if (!isset($keyedUsers[$userLikerId])) {
                        continue;
                    }

                    $content[$commentIndex]['replies'][$replyIndex]['like_users'][$userLikeIndex] = [
                        'id' => $userLikerId,
                        'display_name' => $keyedUsers[$userLikerId]->display_name,
                        'avatar_url' => $keyedUsers[$userLikerId]->profile_picture_url,
                    ];
                }
            }
        }

        return $content;
    }
}
