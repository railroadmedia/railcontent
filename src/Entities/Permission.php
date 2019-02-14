<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\PermissionRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="railcontent_permissions")
 *
 */
class Permission
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     * @var text
     */
    protected $brand;

    /**
     * @return int
     */
    public function getId()
    : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    : string
    {
        return $this->name;
    }

    /**
     * @param string $key
     */
    public function setName(string $name)
    : void {
        $this->name = $name;
    }

    /**
     * @return text
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $key
     */
    public function setBrand(string $brand)
    {
        $this->brand = $brand;
    }

}