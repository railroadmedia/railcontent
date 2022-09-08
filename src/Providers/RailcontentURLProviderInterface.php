<?php

namespace Railroad\Railcontent\Providers;

use Railroad\Railcontent\DataTransferObjects\ContentURLs;
use Railroad\Railcontent\Entities\ContentEntity;

interface RailcontentURLProviderInterface
{
    /**
     * @param $contentId
     * @param $contentSlug
     * @param $contentType
     * @param ContentEntity|null $contentEntity
     * @return ContentURLs|null
     */
    public function getContentURLs(
        $contentId,
        $contentSlug,
        $contentType,
        ContentEntity $contentEntity = null
    );
}
