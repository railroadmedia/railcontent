<?php

namespace Railroad\Railcontent\Providers;

use Railroad\Railcontent\DataTransferObjects\ContentURLs;

interface RailcontentURLProviderInterface
{
    public function getContentURLs($contentId, $contentSlug, $contentType): ?ContentURLs;
}
