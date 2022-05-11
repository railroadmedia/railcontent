<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Support\Collection;
use Railroad\Resora\Decorators\DecoratorInterface;

class AddedToPrimaryPlaylistDecorator extends ModeDecoratorBase
{
    /**
     * @var ContentService
     */
    protected $contentService;
    /**
     * @var ContentRepository
     */
    protected $contentRepository;
    /**
     * @var ContentHierarchyRepository
     */
    protected $contentHierarchyRepository;

    private static $cache = [];

    /**
     * AddedToPrimaryPlaylistDecorator constructor.
     *
     * @param ContentService $contentService
     * @param ContentRepository $contentRepository
     * @param ContentHierarchyRepository $contentHierarchyRepository
     */
    public function __construct(
        ContentService $contentService,
        ContentRepository $contentRepository,
        ContentHierarchyRepository $contentHierarchyRepository,
        UserContentProgressService $userContentProgressService,
        ContentHierarchyService $contentHierarchyService
    ) {
        $this->contentService = $contentService;
        $this->contentRepository = $contentRepository;
        $this->contentHierarchyRepository = $contentHierarchyRepository;
        $this->userContentProgressService = $userContentProgressService;
        $this->contentHierarchyService = $contentHierarchyService;
    }

    /**
     * @param Collection $contents
     * @return mixed
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->whereNotIn('type', ['user-playlist']);

        $contentIds =
            $contentsOfType->pluck('id')
                ->toArray();

        if (empty($contentIds) || empty(user())) {
            return $contents;
        }

        if (key_exists(user()->id, self::$cache)) {
            $userPlaylistContents = self::$cache[user()->id];
        } else {
            $userPlaylistContents = $this->contentRepository->getByUserIdWhereChildIdIn(
                user()->id,
                $contentIds,
                'primary-playlist'
            );

            self::$cache[user()->id] = $userPlaylistContents;
        }

        foreach ($contentsOfType as $index => $content) {
            $contentsOfType[$index]['user_playlists'][user()->id] = [];
            $contentsOfType[$index]['is_added_to_primary_playlist'] = false;
        }

        if (empty($userPlaylistContents[0]['id'])) {
            return $contents;
        }

        $contentsHierarchy = $this->contentHierarchyRepository->getByParentIdWhereChildIdIn(
            $userPlaylistContents[0]['id'],
            $contentsOfType->pluck('id')
                ->toArray()
        );

        $contentsOfType = $contentsOfType->toArray();

        foreach ($contentsOfType as $index => $content) {
            foreach ($userPlaylistContents as $userPlaylistContent) {
                foreach ($contentsHierarchy as $contentHierarchy) {

                    if ($contentHierarchy['parent_id'] == $userPlaylistContent['id'] &&
                        $contentHierarchy['child_id'] == $content['id']) {
                        $contentsOfType[$index]['user_playlists'][user()->id][] = $userPlaylistContent;
                        $contentsOfType[$index]['is_added_to_primary_playlist'] = true;
                    }
                }
            }
        }

        return new Collection($contentsOfType);
    }
}
