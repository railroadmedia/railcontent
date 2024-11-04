<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentLike;

class ContentLikesController
{
    public function all(): array
    {
        $allLikedContent = ContentLike::getAllContentLikedByUser(user()->id);
        return $allLikedContent->pluck('content_id')->toArray();
    }

    public function like(int $contentId): void
    {
        $content = Content::find($contentId);
        if ($content) {
            $like = ContentLike::firstOrCreate(['content_id' => $contentId, 'user_id' => user()->id],
                ['created_on' => now()]);
            $content->like_count++;
            $content->save();
        }
    }

    public function unLike(int $contentId): void
    {
        $wasDeleted = ContentLike::where(['content_id' => $contentId, 'user_id' => user()->id])->delete();
        $content = Content::find($contentId);
        if ($content && $wasDeleted && $content->like_count > 0) {
            $content->like_count--;
            $content->save();
        }
    }


}
