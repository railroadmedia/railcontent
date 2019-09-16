<?php

namespace Railroad\Railcontent\Entities;

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
}