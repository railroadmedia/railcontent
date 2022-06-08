<?php

namespace App\Providers;

use App\Decorators\Content\UrlDecorator;
use Railroad\Railcontent\DataTransferObjects\ContentURLs;
use Railroad\Railcontent\Providers\RailcontentURLProviderInterface;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Support\Collection;

class RailcontentURLProvider implements RailcontentURLProviderInterface
{
    public function getContentURLs($contentId, $contentSlug, $contentType): ?ContentURLs
    {
        if ($contentType == 'assignment' || $contentType == 'vimeo-video' || $contentType == 'youtube-video') {
            return null;
        }

        /**
         * @var $contentService ContentService
         */
        $contentService = app(ContentService::class);

        /**
         * @var $urlDecorator UrlDecorator
         */
        $urlDecorator = app(UrlDecorator::class);

        ContentRepository::$bypassPermissions = true;
        ContentRepository::$pullFutureContent = true;

        $contentEntity = $contentService->getById($contentId);

        if (!empty($contentEntity)) {
            $decoratedEntity = $urlDecorator->decorate(new Collection([$contentEntity]))->first();

            return new ContentURLs(
                parse_url($decoratedEntity['url'] ?? '', PHP_URL_PATH),
                parse_url($decoratedEntity['mobile_app_url'] ?? '', PHP_URL_PATH)
            );
        }

        return null;
    }
}
