<?php

namespace App\Decorators\Content;

use App\Maps\ContentTypes;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Support\Collection;

class UrlDecorator extends ModeDecoratorBase
{
    /**
     * @var ContentService
     */
    protected $contentService;

    /**
     * @var UserContentProgressService
     */
    protected $userContentProgressService;

    /**
     * @var ContentHierarchyService
     */
    protected $contentHierarchyService;

    /**
     * @var ContentRepository
     */
    private $contentRepository;

    private static $contentCache = [];

    public function __construct(
        ContentService $contentService,
        ContentRepository $contentRepository
    ) {
        $this->contentService = $contentService;
        $this->contentRepository = $contentRepository;
    }

    /**
     * @param Collection $contents
     * @return Collection
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

        // todo: if the parents dont exist we need to pull them

        // set url based on type
        foreach ($contents as $contentIndex => $content) {
            $mobileUrl = '';
            $musoraApiUrl = '';

            // learning paths
            if ($content['type'] == 'learning-path') {
                $contents[$contentIndex]['url'] =
                    url()->route('platform.content.first-level', ['method', $content['slug'], $content['id']]);

//                $mobileUrl = url()->route('mobile.members.learning-path.show', [$content['slug']]);
//                $musoraApiUrl = url()->route('mobile.musora-api.learning-path.show', [$content['slug']]);
            }

            // learning path levels
            if ($content['type'] == 'learning-path-level' &&
                !empty($parent = self::$contentCache[$content['parent_id']] ?? null)) {
                $contents[$contentIndex]['url'] =
                    url()->route(
                        'platform.content.second-level',
                        ['method', $parent['slug'], $parent['id'], $content['slug'], $content['id']]
                    );

//                $mobileUrl = url()->route('mobile.members.learning-path.show', [$content['slug']]);
//                $musoraApiUrl = url()->route('mobile.musora-api.learning-path.show', [$content['slug']]);
            }

            // learning path courses
            if ($content['type'] == 'learning-path-course') {
                $contents[$contentIndex]['url'] = url()->route(
                    'platform.content.jump-to-content-id',
                    [
                        $content['id'],
                    ]
                );

//                $mobileUrl = url()->route(
//                    'mobile.members.learning-path.course.show',
//                    [
//                        $content['id'],
//                    ]
//                );
//
//                $musoraApiUrl = url()->route(
//                    'mobile.musora-api.learning-path.course.show',
//                    [
//                        $content['id'],
//                    ]
//                );
            }

            // coaches
            if ($content['type'] == 'instructor') {
                $contents[$contentIndex]['url'] =
                    url()->route('platform.content.first-level', ['coaches', $content['slug'], $content['id']]);

//                $mobileUrl = url()->route('mobile.musora-api.content.show', [$content['id']]);
//                $musoraApiUrl = url()->route('mobile.musora-api.content.show', [$content['id']]);
            }

//            // learning paths
//            if ($content['type'] == 'learning-path') {
//
//                $contents[$contentIndex]['url'] =
//                    url()->route('members.learning-paths.show', [$content['slug'], $content['id']]);
//                self::$contentCache[$content['id']] = $content;
//
//                $mobileUrl = url()->route('mobile.members.learning-path.show', [$content['slug']]);
//                $musoraApiUrl = url()->route('mobile.musora-api.learning-path.show', [$content['slug']]);
//            }
//
//            // units
//            if (($content['type'] == 'unit') && !empty($parent = self::$contentCache[$content['parent_id']] ?? null)) {
//
//                $contents[$contentIndex]['url'] = url()->route(
//                    'members.learning-paths.units.show',
//                    [$parent['slug'], $parent['id'], $content['slug'], $content['id']]
//                );
//
//                self::$contentCache[$content['id']] = $content;
//
//                $mobileUrl = url()->route(
//                    'mobile.musora-api.learning-path.level.show',
//                    [$parent['slug'], $content['slug']]
//                );
//                $musoraApiUrl = url()->route('mobile.musora-api.learning-path.level.show', [$parent['slug'], $content['slug']]);
//                //mobile.musora-api.learning-path.level.show
//            }
//
//            // unit lessons
//            if ($content['type'] == 'unit-part' &&
//                !empty($content['parent_id']) &&
//                !empty($parent1 = self::$contentCache[$content['parent_id']] ?? null) &&
//                !empty($parent1['parent_id']) &&
//                !empty($parent2 = self::$contentCache[$parent1['parent_id']] ?? null)) {
//
//                $contents[$contentIndex]['url'] = url()->route(
//                    'members.learning-paths.units.lessons.show',
//                    [
//                        $parent2['slug'],
//                        $parent2['id'],
//                        $parent1['slug'],
//                        $parent1['id'],
//                        $content['slug'],
//                        $content['id'],
//                    ]
//                );
//
//                self::$contentCache[$content['id']] = $content;
//
//                $mobileUrl = url()->route(
//                    'mobile.musora-api.learning-paths.unit-part.show',
//                    [
//                        $content['id'],
//                    ]
//                );
//
//                $musoraApiUrl= url()->route(
//                    'mobile.musora-api.learning-paths.unit-part.show',
//                    [
//                        $content['id'],
//                    ]
//                );
//            }
//
//            if ($content['type'] == 'learning-path-level') {
//
//                $contents[$contentIndex]['url'] = url()->route(
//                    'members.learning-path.level.show',
//                    [
//                        'pianote-method',
//                        $content['slug'],
//                    ]
//                );
//
//                $mobileUrl = url()->route(
//                    'mobile.musora-api.learning-path.level.show',
//                    [
//                        'pianote-method',
//                        $content['slug'],
//                    ]
//                );
//
//                $musoraApiUrl= url()->route(
//                    'mobile.musora-api.learning-path.level.show',
//                    [
//                        'pianote-method',
//                        $content['slug'],
//                    ]
//                );
//
//            }
//            if ($content['type'] == 'learning-path-course') {
//                $contents[$contentIndex]['url'] = url()->route(
//                    'members.learning-path.jump-to-course',
//                    [
//                        $content['id'],
//                    ]
//                );
//
//                $mobileUrl = url()->route(
//                    'mobile.members.learning-path.course.show',
//                    [
//                        $content['id'],
//                    ]
//                );
//
//                $musoraApiUrl= url()->route(
//                    'mobile.musora-api.learning-path.course.show',
//                    [
//                        $content['id'],
//                    ]
//                );
//            }
//
//            if ($content['type'] == 'learning-path-lesson') {
//                $contents[$contentIndex]['url'] = url()->route(
//                    'members.learning-path.jump-to-lesson',
//                    [
//                        $content['id'],
//                    ]
//                );
//
//                $mobileUrl = url()->route(
//                    'mobile.members.learning-path.level.course.lesson.show',
//                    [
//                        $content['id'],
//                    ]
//                );
//
//                $musoraApiUrl= url()->route(
//                    'mobile.musora-api.learning-path.lesson.show',
//                    [
//                        $content['id'],
//                    ]
//                );
//            }
//
//            // courses/songs
//            if (in_array($content['type'], ContentTypes::$contentTypesWithChildren)) {
//
//                $contents[$contentIndex]['url'] = url()->route(
//                    'members.parent.show',
//                    [
//                        array_flip(ContentTypes::$urlSegmentToContentType)[$content['type']],
//                        $content['slug'],
//                        $content['id'],
//                    ]
//                );
//
//                self::$contentCache[$content['id']] = $content;
//
//                $mobileUrl = url()->route(
//                    'mobile.content.show',
//                    [
//                        $content['id'],
//                    ]
//                );
//
//                $mobileUrl = url()->route(
//                    'mobile.musora-api.content.show',
//                    [
//                        $content['id'],
//                    ]
//                );
//            }
//
//            // lessons with single parent
//            if (in_array($content['type'], ContentTypes::$contentTypesWithSingularParent) &&
//                !empty($parent1 = self::$contentCache[$content['parent_id']] ?? null) &&
//                !empty(array_flip(ContentTypes::$urlSegmentToContentType)[$parent1['type']] ?? null)) {
//
//                $contents[$contentIndex]['url'] = url()->route(
//                    'members.lesson.show',
//                    [
//                        array_flip(ContentTypes::$urlSegmentToContentType)[$parent1['type']],
//                        $parent1['slug'],
//                        $parent1['id'],
//                        $content['slug'],
//                        $content['id'],
//                    ]
//                );
//
//                self::$contentCache[$content['id']] = $content;
//
//                $mobileUrl = url()->route(
//                    'mobile.content.show',
//                    [
//                        $content['id'],
//                    ]
//                );
//
//                $musoraApiUrl = url()->route(
//                    'mobile.musora-api.content.show',
//                    [
//                        $content['id'],
//                    ]
//                );
//            }
//
//            // lessons without parents
//            if (in_array($content['type'], ContentTypes::$lessonContentTypesWithoutParents) &&
//                !empty(array_flip(ContentTypes::$urlSegmentToContentType)[$content['type']] ?? null)) {
//
//                $contents[$contentIndex]['url'] = url()->route(
//                    'members.lesson.show',
//                    [
//                        array_flip(ContentTypes::$urlSegmentToContentType)[$content['type']],
//                        $content['slug'],
//                        $content['id'],
//                    ]
//                );
//                self::$contentCache[$content['id']] = $content;
//
//                $mobileUrl = url()->route(
//                    'mobile.content.show',
//                    [
//                        $content['id'],
//                    ]
//                );
//
//                $mobileUrl = url()->route(
//                    'mobile.musora-api.content.show',
//                    [
//                        $content['id'],
//                    ]
//                );
//            }
//
//            if ($content['type'] == 'pack-bundle') {
//                $mobileUrl = url()->route(
//                    'mobile.content.show',
//                    [
//                        $content['id'],
//                    ]
//                );
//            }
//
//
//            if ($content['type'] == 'instructor') {
//
//                $contents[$contentIndex]['url'] =
//                    url()->route('members.coaches.show', [ $content['slug']]);
//                self::$contentCache[$content['id']] = $content;
//
//                $mobileUrl = url()->route('mobile.musora-api.content.show', [$content['id']]);
//                $musoraApiUrl = url()->route('mobile.musora-api.content.show', [$content['id']]);
//            }
//
//            $content['mobile_app_url'] = $mobileUrl;
//
//            $content['musora_api_mobile_app_url'] = $musoraApiUrl;
        }


        return $contents;
    }

    public function fetchAndCacheParents($contents)
    {
        $childIds = [];
        $parentTypes = [];

        foreach ($contents as $content) {
            if (isset(ContentTypes::$childParentTypeMap[$content['type']])) {
                $childIds[] = $content['id'];
                $parentTypes[] = ContentTypes::$childParentTypeMap[$content['type']];
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
