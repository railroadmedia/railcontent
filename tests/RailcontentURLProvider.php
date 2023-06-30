<?php

namespace Railroad\Railcontent\Tests;

use App\Decorators\Content\UrlDecorator;
use Railroad\Railcontent\DataTransferObjects\ContentURLs;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Providers\RailcontentURLProviderInterface;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Support\Collection;

class RailcontentURLProvider implements RailcontentURLProviderInterface
{
    public function getContentURLs(
        $contentId,
        $contentSlug,
        $contentType,
        ContentEntity $contentEntity = null
    ): ?ContentURLs {
        return null;
    }
}
