<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Repositories\UserPlaylistContentRepository;
use Railroad\Railcontent\Repositories\UserPlaylistsRepository;
use Railroad\Railcontent\Support\Collection;

class AddedToPrimaryPlaylistDecorator extends ModeDecoratorBase
{
    /**
     * @var UserPlaylistContentRepository
     */
    protected $userPlaylistContentRepository;
    /**
     * @var UserPlaylistsRepository
     */
    protected $userPlaylistsRepository;

    private static $cache = [];

    public static $skip = false;

    public function __construct(
        UserPlaylistContentRepository $userPlaylistContentRepository,
        UserPlaylistsRepository $userPlaylistsRepository
    ) {
        $this->userPlaylistContentRepository = $userPlaylistContentRepository;
        $this->userPlaylistsRepository = $userPlaylistsRepository;
    }

    /**
     * @return mixed
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->whereNotIn('type', ['user-playlist', 'instructor','artist','style']);

        $contentIds =
            $contentsOfType->pluck('id')
                ->toArray();

        if (empty($contentIds) || empty(user()) || self::$skip) {
            return $contents;
        }

        $userPlaylist =
            \Arr::first($this->userPlaylistsRepository->getUserPlaylist(user()->id, 'primary-playlist', brand()));

        if (empty($userPlaylist)) {
            $userPlaylist =
                \Arr::first($this->userPlaylistsRepository->getUserPlaylist(user()->id, 'user-playlist', brand()));
        }

        foreach ($contentsOfType as $index => $content) {
            $contentsOfType[$index]['user_playlists'][user()->id] = [];
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
