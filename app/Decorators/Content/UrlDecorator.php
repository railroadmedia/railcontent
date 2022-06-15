<?php

namespace App\Decorators\Content;

use App\Maps\ContentTypeHierarchyMap;
use App\Maps\PrimaryURLSlugToContentTypeMap;
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
     * @param Collection $contents
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

        $contents = $this->fetchAndCacheParents($contents);

        // set url based on type
        foreach ($contents as $contentIndex => $content) {
            $contentTypeToURLSlugMap = array_flip(PrimaryURLSlugToContentTypeMap::$map);

            // first-level types
            if (empty($content['parent_id']) &&
                !empty($contentTypeToURLSlugMap[$content['type']])) {
                $contents[$contentIndex]['url'] =
                    url()->route(
                        'platform.content.first-level',
                        [
                            'brand' => $content['brand'],
                            $contentTypeToURLSlugMap[$content['type']],
                            $content['slug'],
                            $content['id']
                        ]
                    );
            }

            // second-level types
            if (!empty($content['parent_id']) &&
                !empty($parent1 = self::$contentCache[$content['parent_id']] ?? null) &&
                empty($parent1['parent_id']) &&
                !empty($contentTypeToURLSlugMap[$parent1['type']])) {
                $contents[$contentIndex]['url'] =
                    url()->route(
                        'platform.content.second-level',
                        [
                            'brand' => $content['brand'],
                            $contentTypeToURLSlugMap[$parent1['type']],
                            $parent1['slug'],
                            $parent1['id'],
                            $content['slug'],
                            $content['id']
                        ]
                    );
            }

            // third-level types
            if (!empty($content['parent_id']) &&
                !empty($parent1 = self::$contentCache[$content['parent_id']] ?? null) &&
                !empty($parent1['parent_id']) &&
                !empty($parent2 = self::$contentCache[$parent1['parent_id']] ?? null) &&
                !empty($contentTypeToURLSlugMap[$parent2['type']])) {
                $contents[$contentIndex]['url'] = url()->route(
                    'platform.content.third-level',
                    [
                        'brand' => $content['brand'],
                        $contentTypeToURLSlugMap[$parent2['type']],
                        $parent2['slug'],
                        $parent2['id'],
                        $parent1['slug'],
                        $parent1['id'],
                        $content['slug'],
                        $content['id'],
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
