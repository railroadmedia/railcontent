<?php

namespace App\Decorators\Content;

use App\Maps\ContentTypeHierarchyMap;
use App\Maps\PrimaryURLSlugToContentTypeMap;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Support\Collection;

class UrlDecorator extends ModeDecoratorBase
{
    private ContentRepository $contentRepository;

    private static array $contentCache = [];

    public function __construct(
        ContentRepository $contentRepository
    ) {
        $this->contentRepository = $contentRepository;
    }

    /**
     * @param Collection|ContentEntity[] $contents
     * @return array|Collection
     */
    public function decorate(Collection $contents)
    {
        if ($contents->isEmpty()) {
            return $contents;
        }

        // first cache all the contents
        foreach ($contents as $content) {
            self::$contentCache[$content['id']] = $content;
        }

        // set url based on type
        foreach ($contents as $contentIndex => $content) {
            /**
             * @var $content ContentEntity
             */

            $contentTypeToURLSlugMap = array_flip(PrimaryURLSlugToContentTypeMap::$map);
            $contentParentData = $content->getParentContentData();

            // first-level types
            if (count($contentParentData) == 1 &&
                !empty($contentTypeToURLSlugMap[$content['type']])) {
                $contents[$contentIndex]['url'] =
                    url()->route(
                        'platform.content.first-level',
                        [
                            'brand' => $content['brand'],
                            $contentTypeToURLSlugMap[$content['type']],
                            $contentParentData[0]->slug,
                            $contentParentData[0]->id,
                        ]
                    );
            }

            // second-level types
            if (count($contentParentData) == 2 &&
                !empty($contentTypeToURLSlugMap[$contentParentData[1]->type])) {
                $contents[$contentIndex]['url'] =
                    url()->route(
                        'platform.content.second-level',
                        [
                            'brand' => $content['brand'],
                            $contentTypeToURLSlugMap[$contentParentData[1]->type],
                            $contentParentData[1]->slug,
                            $contentParentData[1]->id,
                            $contentParentData[0]->slug,
                            $contentParentData[0]->id,
                        ]
                    );
            }

            // third-level types
            if (count($contentParentData) == 3 &&
                !empty($contentTypeToURLSlugMap[$contentParentData[2]->type])) {
                $contents[$contentIndex]['url'] = url()->route(
                    'platform.content.third-level',
                    [
                        'brand' => $content['brand'],
                        $contentTypeToURLSlugMap[$contentParentData[2]->type],
                        $contentParentData[2]->slug,
                        $contentParentData[2]->id,
                        $contentParentData[1]->slug,
                        $contentParentData[1]->id,
                        $contentParentData[0]->slug,
                        $contentParentData[0]->id,
                    ]
                );
            }
        }

        return $contents;
    }

    public function fetchAndCacheParents($contents)
    {
        $childIds = [];
        $parentTypes = [];

        foreach ($contents as $content) {
            if (isset(array_flip(ContentTypeHierarchyMap::$map)[$content['type']])) {
                $childIds[] = $content['id'];
                $parentTypes[] = array_flip(ContentTypeHierarchyMap::$map)[$content['type']];
            }
        }

        if (!empty($childIds)) {
            $rows =
                $this->contentRepository->query()
                    ->restrictByUserAccess()
                    ->leftJoin(
                        ConfigService::$tableContentHierarchy,
                        ConfigService::$tableContentHierarchy . '.parent_id',
                        '=',
                        ConfigService::$tableContent . '.id'
                    )
                    ->whereIn(ConfigService::$tableContentHierarchy . '.child_id', $childIds)
                    ->whereIn(ConfigService::$tableContent . '.type', $parentTypes)
                    ->selectInheritenceColumns()
                    ->getToArray();

            foreach ($rows as $row) {
                foreach (self::$contentCache as $contentId => $content) {
                    if ($contentId == $row['child_id']) {
                        self::$contentCache[$contentId]['parent_id'] = $row['parent_id'];
                    }
                }

                foreach ($contents as $contentIndex => $content) {
                    if ($content['id'] == $row['child_id']) {
                        $contents[$contentIndex]['parent_id'] = $row['parent_id'];
                    }
                }
            }

            $newContents =
                $this->contentRepository->query()
                    ->selectPrimaryColumns()
                    ->restrictByUserAccess()
                    ->whereIn(ConfigService::$tableContent . '.id', array_column($rows, 'parent_id'))
                    ->getToArray();

            foreach ($newContents as $parent) {
                self::$contentCache[$parent['id']] = $parent;
            }

            $this->fetchAndCacheParents($newContents);
        }

        return $contents;
    }
}
