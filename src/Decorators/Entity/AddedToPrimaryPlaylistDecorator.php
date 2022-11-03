<?php

namespace Railroad\Railcontent\Decorators\Entity;

use Railroad\Railcontent\Repositories\UserPlaylistContentRepository;
use Railroad\Railcontent\Repositories\UserPlaylistsRepository;
use Railroad\Railcontent\Support\Collection;
use Railroad\Railcontent\Decorators\DecoratorInterface;

class AddedToPrimaryPlaylistDecorator implements DecoratorInterface
{
    /**
     * @var UserPlaylistContentRepository
     */
    protected $userPlaylistContentRepository;
    /**
     * @var UserPlaylistsRepository
     */
    protected $userPlaylistsRepository;

    public static $skip = false;

    /**
     * @param  UserPlaylistContentRepository  $userPlaylistContentRepository
     * @param  UserPlaylistsRepository  $userPlaylistsRepository
     */
    public function __construct(
        UserPlaylistContentRepository $userPlaylistContentRepository,
        UserPlaylistsRepository $userPlaylistsRepository
    ) {
        $this->userPlaylistContentRepository = $userPlaylistContentRepository;
        $this->userPlaylistsRepository = $userPlaylistsRepository;
    }

    /**
     * @param  Collection  $contents
     * @return mixed
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->whereNotIn('type', ['user-playlist', 'instructor']);

        $contentIds =
            $contentsOfType->pluck('id')
                ->toArray();

        if (empty($contentIds) || empty(auth()->id()) || self::$skip) {
            return $contents;
        }

        $userPlaylist =
            \Arr::first($this->userPlaylistsRepository->getUserPlaylist(auth()->id(), 'primary-playlist', brand()));

        foreach ($contentsOfType as $index => $content) {
            $contentsOfType[$index]['user_playlists'][auth()->id()] = [];
            $contentsOfType[$index]['is_added_to_primary_playlist'] = false;
        }

        if (empty($userPlaylist)) {
            return $contents;
        }

        $areContentIdsInPlaylist =
            $this->userPlaylistContentRepository->areContentIdsInPlaylist($contentIds, $userPlaylist['id']);

        $contentsOfType = $contentsOfType->toArray();

        foreach ($contentsOfType as $index => $content) {
            $contentsOfType[$index]['is_added_to_primary_playlist'] = $areContentIdsInPlaylist[$content['id']] ?? false;
        }

        return new Collection($contentsOfType);
    }
}
