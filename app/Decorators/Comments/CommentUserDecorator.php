<?php

namespace App\Decorators\Comments;

use App\Decorators\Content\ModeDecoratorBase;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Support\Collection;

class CommentUserDecorator extends ModeDecoratorBase
{
    public function decorate(Collection $comments)
    {
        $userIds = [];

        foreach ($comments as $commentIndex => $comment) {
            $comment['created_on_diff'] =
                Carbon::parse($comment['created_on'])
                    ->diffForHumans();

            $userIds[] = $comment['user_id'];

            foreach ($comment['replies'] ?? [] as $replyIndex => $reply) {
                $userIds[] = $reply['user_id'];
            }
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

        foreach ($comments->toArray() as $commentIndex => $comment) {
            if (!isset($keyedUsers[$comment['user_id']])) {
                unset($comments[$commentIndex]);

                continue;
            }

            /**
             * @var $user User
             */
            $commentAuthor = $keyedUsers[$comment['user_id']];

            $comments[$commentIndex]['user'] = [];
            $comments[$commentIndex]['user']['display_name'] = $commentAuthor['display_name'];
            $comments[$commentIndex]['user']['fields.profile_picture_image_url'] =
                $commentAuthor['profile_picture_url'];
            $comments[$commentIndex]['user']['xp'] = $commentAuthor->getBrandTotalXp();
            $comments[$commentIndex]['user']['rank'] = $commentAuthor->getXpRank();
            $comments[$commentIndex]['user']['access_level'] = $commentAuthor['access_level'];
            $comments[$commentIndex]['user']['xp_level'] = $commentAuthor->getMethodLevel();
            $comments[$commentIndex]['user']['level_number'] = $commentAuthor->getMethodLevel();

            foreach ($comment['replies'] ?? [] as $replyIndex => $reply) {
                $comments[$commentIndex]['replies'][$replyIndex]['created_on_diff'] =
                    Carbon::parse($reply['created_on'])
                        ->diffForHumans();

                if (!isset($keyedUsers[$reply['user_id']])) {
                    continue;
                }

                /**
                 * @var $replyAuthor User
                 */
                $replyAuthor = $keyedUsers[$reply['user_id']];

                $comments[$commentIndex]['replies'][$replyIndex]['user'] = [];

                $comments[$commentIndex]['replies'][$replyIndex]['user']['display_name'] =
                    $replyAuthor['display_name'];

                $comments[$commentIndex]['replies'][$replyIndex]['user']['xp'] =
                    $replyAuthor->getBrandTotalXp();

                $comments[$commentIndex]['replies'][$replyIndex]['user']['rank'] =
                    $replyAuthor->getXpRank();

                $comments[$commentIndex]['replies'][$replyIndex]['user']['access_level'] = $replyAuthor['access_level'];
                $comments[$commentIndex]['replies'][$replyIndex]['user']['level_number'] = $replyAuthor->getMethodLevel();
                $comments[$commentIndex]['replies'][$replyIndex]['user']['fields.profile_picture_image_url'] =
                    $replyAuthor['profile_picture_url'];
            }
        }
        return $comments;
    }
}
