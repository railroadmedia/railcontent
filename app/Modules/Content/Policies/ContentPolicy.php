<?php

namespace App\Modules\Content\Policies;

use App\Modules\Content\Models\Content;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Services\ContentService;

class ContentPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        // allow admin users to perform any action
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    public function view(User $user, Content $content): bool
    {
        // check available statues
        if (collect([ContentService::STATUS_PUBLISHED, ContentService::STATUS_ARCHIVED, ContentService::STATUS_UNLISTED])->doesntContain($content->status)) {
            return false;
        }

        // published date must be past - handle for either Carbon or string
        $publishedOn = Carbon::make($content->published_on);
        if (is_null($publishedOn) || $publishedOn->isFuture()) {
            return false;
        }

        return true;
    }
}
