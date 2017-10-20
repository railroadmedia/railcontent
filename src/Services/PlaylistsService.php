<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\PlaylistRepository;
use Railroad\Railcontent\Repositories\UserContentRepository;

class PlaylistsService
{
    /**
     * @var PlaylistRepository
     */
    protected $playlistsRepository;

    /**
     * @var UserContentRepository
     */
    protected$userContentRepository;

    // playlist types
    const TYPE_PUBLIC = 'public';
    const TYPE_PRIVATE = 'private';

    /**
     * PlaylistsService constructor.
     *
     * @param PlaylistRepository $playlistsRepository
     * @param UserContentRepository $userContentRepository
     */
    public function __construct(
        PlaylistRepository $playlistsRepository,
        UserContentRepository $userContentRepository
    ) {
        $this->playlistsRepository = $playlistsRepository;
        $this->userContentRepository = $userContentRepository;
    }

    /**
     * Call the repository method to save user content to playlist.
     * If the content it's not associated with the user, call the repository method to save user content
     *
     * @param int $contentId
     * @param int $playlistId
     * @param int $userId
     * @return array - the playlist with associated user's content
     */
    public function addToPlaylist($contentId, $playlistId, $userId)
    {
        $userContent = $this->userContentRepository->getUserContent($contentId, $userId);

        $userContentId =
            (!$userContent) ?
                $this->userContentRepository->saveUserContent(
                    $contentId,
                    $userId,
                    UserContentService::STATE_ADDED_TO_LIST
                ) :
                $userContent['id'];

        return $this->playlistsRepository->addToPlaylist($userContentId, $playlistId) > 0;

        //return $this->getPlaylist($playlistId, $userId);
    }

    /**
     * Call the methods from the repository that get the playlist with the associated user's content
     *
     * @param int $playlistId
     * @param int $userId
     * @return array
     */
    public function getPlaylist($playlistId, $userId)
    {
        return $this->playlistsRepository->get($playlistId, $userId);
    }

    /**
     * Call the repository method to save a new playlist. If the authenticated user it's admin the playlist type it's PUBLIC, otherwise it's PRIVATE
     *
     * @param string $name
     * @param int $userId
     * @param int|null $isAdmin
     * @return array - the playlist with associated user contents
     */
    public function store($name, $userId, $isAdmin)
    {
        $type = ($isAdmin == 1) ? $this::TYPE_PUBLIC : $this::TYPE_PRIVATE;

        $playlistId = $this->playlistsRepository->store($name, $userId, $type);

        return $playlistId > 0;
        //return $this->getPlaylist($playlistId, $userId);
    }

    public function getPlaylists()
    {
        return $this->playlistsRepository->getUserPlaylists(
            $this->playlistsRepository->getAuthenticatedUserId(request())
        );
    }
}