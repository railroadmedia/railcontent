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

    /**
     * @param UserPlaylistContentRepository $userPlaylistContentRepository
     * @param UserPlaylistsRepository $userPlaylistsRepository
     */
    public function __construct(
        UserPlaylistContentRepository $userPlaylistContentRepository,
        UserPlaylistsRepository $userPlaylistsRepository
    ) {
        $this->userPlaylistContentRepository = $userPlaylistContentRepository;
        $this->userPlaylistsRepository = $userPlaylistsRepository;
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
            $userPlaylist =
                \Arr::first($this->userPlaylistsRepository->getUserPlaylist(user()->id, 'primary-playlist', brand()));

            if ($userPlaylist) {
                $userPlaylistContents =
                    $this->userPlaylistContentRepository->getUserPlaylistContents($userPlaylist['id']);

                self::$cache[user()->id] = $userPlaylistContents;
            }
        }

        foreach ($contentsOfType as $index => $content) {
            $contentsOfType[$index]['user_playlists'][user()->id] = [];
            $contentsOfType[$index]['is_added_to_primary_playlist'] = false;
        }

        if (empty($userPlaylistContents[0]['id'])) {
            return $contents;
        }

        $contentsOfType = $contentsOfType->toArray();

        foreach ($contentsOfType as $index => $content) {
            foreach ($userPlaylistContents as $userPlaylistContent) {
                if ($userPlaylistContent['id'] == $content['id']) {
                    $contentsOfType[$index]['user_playlists'][user()->id][] = $userPlaylistContent;
                    $contentsOfType[$index]['is_added_to_primary_playlist'] = true;
                }
            }
        }

        return new Collection($contentsOfType);
    }
}
