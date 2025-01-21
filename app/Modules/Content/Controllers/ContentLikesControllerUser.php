<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentLike;
use App\Modules\DataVersion\Controllers\UserDataVersionController;
use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;
use Modules\UserManagementSystem\Models\User;

class ContentLikesControllerUser extends UserDataVersionController
{
    public function getDataVersionKey(): UserDataVersionKeyEnum
    {
        return UserDataVersionKeyEnum::Content;
    }

    public function getData(User $user): array
    {
        $allLikedContent = ContentLike::getAllContentLikedByUser($user->id);
        return $allLikedContent->pluck('content_id')->toArray();
    }

    public function like(int $contentId): array
    {
        $like = ContentLike::firstOrCreate(['content_id' => $contentId, 'user_id' => user()->id], ['created_on' => now()]);
        $content = Content::find($contentId);
        if ($content) {
            $content->like_count++;
            $content->save();
        }
        return $this->dataUpdateResponse($like->wasRecentlyCreated);
    }

    public function unLike(int $contentId): array
    {
        $wasDeleted = ContentLike::where(['content_id' => $contentId, 'user_id' => user()->id])->delete();
        $content = Content::find($contentId);
        if ($content && $wasDeleted && $content->like_count > 0) {
            $content->like_count--;
            $content->save();
        }
        return $this->dataUpdateResponse($wasDeleted);
    }


}
