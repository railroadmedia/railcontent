<?php

namespace App\Modules\Brand\Enums;

enum Status: string
{
    case STATUS_DRAFT = 'draft';
    case STATUS_PUBLISHED = 'published';
    case STATUS_SCHEDULED = 'scheduled';
    case STATUS_ARCHIVED = 'archived';
    case STATUS_DELETED = 'deleted';
    case STATUS_UNLISTED = 'unlisted';

    public static function isVisibleForPlaylists(self $status): bool
    {
        return !in_array($status, [self::STATUS_DRAFT, self::STATUS_DELETED]);
    }
}
