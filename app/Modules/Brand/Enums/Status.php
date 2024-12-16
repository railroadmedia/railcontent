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
}
