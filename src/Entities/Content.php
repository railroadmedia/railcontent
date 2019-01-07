<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JMS\Serializer\Annotation as Serializer;

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
     * @ORM\Column(type="string", name="slug")
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
     * @var \DateTime $createdOn
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $createdOn;

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
    public function setUserId($userId)
    : void {
        $this->userId = $userId;
    }

    /**
     * Sets publishedOn.
     *
     * @param  \DateTime $publishedOn
     * @return $this
     */
    public function setPublishedOn($publishedOn)
    {
        $this->publishedOn = $publishedOn;

        return $this;
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

    public function setParameters($parameters)
    {
        foreach ($parameters as $key => $value) {
            switch ($key) {
                case 'slug':
                    $this->slug = $value;
                    break;
                case 'type':
                    $this->type = $value;
                    break;
                case 'sort':
                    $this->sort = $value;
                    break;
                case 'status':
                    $this->status = $value;
                    break;
                case 'brand':
                    $this->brand = $value;
                    break;
                case 'language':
                    $this->language = $value;
                    break;
                case 'published_on':
                    $this->publishedOn = $value;
                    break;
                case 'archived_on':
                    $this->archivedOn = $value;
                    break;
            }
        }
        return $this;
    }
}