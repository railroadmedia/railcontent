<?php

namespace App\Modules\Content\Models\Sanity\Enums;

/**
 * Video Types supported
 */
enum VideoType: string
{
    case Vimeo = 'vimeo';
    case Youtube = 'youtube';
}
