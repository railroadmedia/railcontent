<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/21/2017
 * Time: 9:10 AM
 */

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\PlaylistsRepository;
use Railroad\Railcontent\Repositories\UserContentRepository;

class PlaylistsService
{

    protected $playlistsRepository, $userContentRepository;

    // playlist type
    const TYPE_PUBLIC = 'public';
    const TYPE_PRIVATE = 'private';

    /**
     * PlaylistsService constructor.
     * @param $playlistsRepository
     */
    public function __construct(PlaylistsRepository $playlistsRepository, UserContentRepository $userContentRepository)
    {
        $this->playlistsRepository = $playlistsRepository;
        $this->userContentRepository = $userContentRepository;
        $this->user = $this->playlistsRepository->getAuthenticatedUserId(request());
    }

    /**
     * Call the repository method to save user content to playlist.
     * If the content it's not associated with the user call the repository method to save user content
     *
     * @param $contentId
     * @param $playlistId
     * @return int
     */
    public function addToPlaylist($contentId, $playlistId)
    {
        $userContent = $this->userContentRepository->getUserContent($contentId, $this->user);

        $userContentId = (!$userContent) ? $this->userContentRepository->saveUserContent($contentId, $this->user, UserContentService::STATE_ADDED_TO_LIST) :
            $userContent['id'];

        return $this->playlistsRepository->addToPlaylist($userContentId, $playlistId);
    }

    /**
     * Call the repository method to save a new playlist. If the authenticated user it's admin the playlist it's public, otherwise it's private
     * @param string $name
     * @return mixed
     */
    public function store($name)
    {
        $type = (request()->user['is_admin'] == 1) ? $this::TYPE_PUBLIC : $this::TYPE_PRIVATE;

        return $this->playlistsRepository->store($name, $this->user, $type);
    }
}