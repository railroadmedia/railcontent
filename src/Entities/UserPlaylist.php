<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\UserPlaylistRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="railcontent_user_playlists")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 *
 */
class UserPlaylist
{
    use TimestampableEntity;
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     * @var text
     */
    protected $brand;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $type;

    /**
     * @var User
     *
     * @ORM\Column(type="user_id", name="user_id")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\UserPlaylistContent", mappedBy="userPlaylist", cascade={"remove","persist"})
     * @ORM\JoinColumn(name="id", referencedColumnName="user_playlist_id")
     */
    protected $playlistContent;

    /**
     * UserPlaylist constructor.
     */
    public function __construct()
    {
        $this->playlistContent = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    : int
    {
        return $this->id;
    }

    /**
     * @return text
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getType()
    : string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return User|null
     */
    public function getUser()
    : User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param UserPlaylistContent $userPlaylistContent
     */
    public function addPlaylistContent(UserPlaylistContent $userPlaylistContent)
    {
        $this->playlistContent[] = $userPlaylistContent;
    }

    /**
     * @return ArrayCollection
     */
    public function getPlaylistContent()
    {
        return $this->playlistContent;
    }

}