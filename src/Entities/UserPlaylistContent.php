<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="railcontent_user_playlist_content",
 *     indexes={
 *         @ORM\Index(name="upc", columns={"user_playlist_id","content_id"}),
 *         @ORM\Index(name="railcontent_user_playlist_content_content_id_index", columns={"content_id"}),
 *         @ORM\Index(name="railcontent_user_playlist_content_user_playlist_id_index", columns={"user_playlist_id"}),
 *         @ORM\Index(name="railcontent_user_playlist_content_created_at_index", columns={"created_at"}),
 *         @ORM\Index(name="railcontent_user_playlist_content_updated_at_index", columns={"updated_at"})
 *     }
 * )
 *
 */
class UserPlaylistContent extends ArrayExpressible
{
    use TimestampableEntity;

    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     *
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\UserPlaylist")
     * @ORM\JoinColumn(name="user_playlist_id", referencedColumnName="id")
     *
     */
    private $userPlaylist;

    /**
     * @return int
     */
    public function getId()
    : int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param Content $content
     */
    public function setContent(Content $content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getUserPlaylist()
    {
        return $this->userPlaylist;
    }

    /**
     * @param $playlist
     */
    public function setUserPlaylist($playlist)
    {
        $this->userPlaylist = $playlist;
    }
}