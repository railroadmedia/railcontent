<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Entities\UserPlaylist;
use Railroad\Railcontent\Entities\UserPlaylistContent;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class UserPlaylistService
{
    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $userPlaylistRepository;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $contentUserPlaylistRepository;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $contentRepository;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * UserPlaylistService constructor.
     *
     * @param RailcontentEntityManager $entityManager
     * @param UserProviderInterface $userProvider
     */
    public function __construct(
        RailcontentEntityManager $entityManager,
        UserProviderInterface $userProvider
    ) {
        $this->entityManager = $entityManager;
        $this->userProvider = $userProvider;

        $this->userPlaylistRepository = $this->entityManager->getRepository(UserPlaylist::class);
        $this->contentUserPlaylistRepository = $this->entityManager->getRepository(UserPlaylistContent::class);
        $this->contentRepository = $this->entityManager->getRepository(Content::class);
    }

    /** Save/update user playlist
     *
     * @param $attributes
     * @param $values
     * @return object|UserPermission|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function updateOrCeate($userId, $type, $brand)
    {
        $user = $this->userProvider->getUserById($userId);

        $userPlaylist = $this->userPlaylistRepository->getUserPlaylist($user, $type, $brand);

        if (!$userPlaylist) {
            $userPlaylist = new UserPlaylist();
            $userPlaylist->setUser($user);
            $userPlaylist->setBrand($brand);
            $userPlaylist->setType($type);
            $userPlaylist->setCreatedAt(Carbon::now());

            $this->entityManager->persist($userPlaylist);
            $this->entityManager->flush();
        }

        return $userPlaylist;
    }

    /**
     * @param $userId
     * @param $playlistType
     * @return object|null
     */
    public function userPlaylist($userId, $playlistType)
    {
        $user = $this->userProvider->getUserById($userId);

        $userPlaylist = $this->userPlaylistRepository->findOneBy(
            [
                'user' => $user,
                'type' => $playlistType,
            ]
        );

        return $userPlaylist;
    }

    /**
     * @param $userPlaylistId
     * @param $contentId
     * @return UserPlaylistContent
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addContentToUserPlaylist($userPlaylistId, $contentId)
    {
        $content = $this->contentRepository->find($contentId);
        $userPlaylist = $this->userPlaylistRepository->find($userPlaylistId);

        $userPlaylistContent = new UserPlaylistContent();
        $userPlaylistContent->setContent($content);
        $userPlaylistContent->setUserPlaylist($userPlaylist);
        $userPlaylistContent->setCreatedAt(Carbon::now());

        $this->entityManager->persist($userPlaylistContent);
        $this->entityManager->flush();

        return $userPlaylistContent;
    }

    /**
     * @param $userPlaylistId
     * @param $contentId
     * @return bool
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function removeContentFromUserPlaylist($userPlaylistId, $contentId)
    {
        $content = $this->contentRepository->find($contentId);
        $userPlaylist = $this->userPlaylistRepository->find($userPlaylistId);

        $userPlaylistContent = $this->contentUserPlaylistRepository->findOneBy(
            [
                'content' => $content,
                'userPlaylist' => $userPlaylist,
            ]
        );

        if (!$userPlaylistContent) {
            return true;
        }

        $this->entityManager->remove($userPlaylistContent);
        $this->entityManager->flush();
    }
}