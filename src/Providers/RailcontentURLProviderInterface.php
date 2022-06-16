<?php

namespace Railroad\Railcontent\Providers;

use Railroad\Railcontent\DataTransferObjects\ContentURLs;
use Railroad\Railcontent\Entities\ContentEntity;

interface RailcontentURLProviderInterface
{
    public function getContentURLs(
        $contentId,
        $contentSlug,
        $contentType,
        ContentEntity $contentEntity = null
    ): ?ContentURLs;
}
