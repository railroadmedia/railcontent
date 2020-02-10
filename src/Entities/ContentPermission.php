<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="railcontent_content_permissions",
 *     indexes={
 *         @ORM\Index(name="railcontent_content_permissions_content_id_index", columns={"content_id"}),
 *         @ORM\Index(name="railcontent_content_permissions_content_type_index", columns={"content_type"}),
 *         @ORM\Index(name="railcontent_content_permissions_permission_id_index", columns={"permission_id"}),
 *         @ORM\Index(name="railcontent_content_permissions_brand_index", columns={"brand"})
 *     }
 * )
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 *
 */
class ContentPermission
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true, name = "content_type")
     * @var string
     */
    protected $contentType;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $brand;

    /**
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     *
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Permission")
     * @ORM\JoinColumn(name="permission_id", referencedColumnName="id")
     *
     */
    private $permission;

    /**
     * @return int
     */
    public function getId()
    : int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * @return string
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
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param Content $content
     */
    public function setContent(?Content $content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * @param Permission $permission
     */
    public function setPermission(Permission $permission)
    {
        $this->permission = $permission;
    }
}