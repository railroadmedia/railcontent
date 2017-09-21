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

    /**
     * PlaylistsService constructor.
     * @param $playlistsRepository
     */
    public function __construct(PlaylistsRepository $playlistsRepository, UserContentRepository $userContentRepository)
    {
        $this->playlistsRepository = $playlistsRepository;
        $this->userContentRepository = $userContentRepository;
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
        $userId = $this->userContentRepository->getAuthenticatedUserId();

        $userContentId = $this->userContentRepository->getUserContent($contentId, $userId);

        if(!$userContentId) {
            $userContentId = $this->userContentRepository->saveUserContent($contentId, $userId, UserContentService::STATE_ADDED_TO_LIST);
        }

        return  $this->playlistsRepository->addToPlaylist($userContentId, $playlistId);
    }
}