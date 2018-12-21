<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\ContentRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="railcontent_content")
 *
 */
class Content
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
    protected $slug;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $type;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $sort;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $status;

    /**
     * @ORM\Column(type="text")
     * @var text
     */
    protected $brand;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $language;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var integer
     */
    protected $userId;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    protected $publishedOn;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    protected $archivedOn;

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
    public function getSlug()
    : string
    {
        return $this->slug;
    }

    /**
     * @param string $key
     */
    public function setSlug(string $slug)
    : void {
        $this->slug = $slug;
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
     * @param string $key
     */
    public function setType(string $type)
    : void {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getSort()
    : string
    {
        return $this->sort;
    }

    /**
     * @param string $key
     */
    public function setSort(string $sort)
    : void {
        $this->sort = $sort;
    }

    /**
     * @return string
     */
    public function getStatus()
    : string
    {
        return $this->status;
    }

    /**
     * @param string $key
     */
    public function setStatus(string $status)
    : void {
        $this->status = $status;
    }

    /**
     * @return text
     */
    public function getBrand()
    : string
    {
        return $this->brand;
    }

    /**
     * @param string $key
     */
    public function setBrand(string $brand)
    : void {
        $this->brand = $brand;
    }

    /**
     * @return text
     */
    public function getLanguage()
    : string
    {
        return $this->language;
    }

    /**
     * @param string $key
     */
    public function setLanguage(string $language)
    : void {
        $this->language = $language;
    }

    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param integer $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * Sets publishedOn.
     *
     * @param  string $publishedOn
     * @return $this
     */
    public function setPublishedOn($publishedOn)
    {
        $this->publishedOn = $publishedOn;
    }

    /**
     * Returns publishedOn.
     *
     * @return string
     */
    public function getPublishedOn()
    {
        return $this->publishedOn;
    }

    /**
     * Sets archivedOn.
     *
     * @param  string $archivedOn
     * @return $this
     */
    public function setArchivedOn($archivedOn)
    {
        $this->archivedOn = $archivedOn;
    }

    /**
     * Returns archivedOn.
     *
     * @return string
     */
    public function getArchivedOn()
    {
        return $this->archivedOn;
    }
}