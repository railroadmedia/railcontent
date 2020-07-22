<?php

namespace Railroad\Railcontent\Entities;

use Railroad\Doctrine\Contracts\UserEntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Railroad\Railcontent\Entities\Traits\DecoratedFields;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="users")
 */
class User implements UserEntityInterface
{
    use DecoratedFields;

    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $displayName;

    /**
     * @var
     */
    private $avatar;

    private $drumsSkillLevel;

    private $guitarSkillLevel;

    private $pianoSkillLevel;

    /**
     * User constructor.
     *
     * @param int $id
     * @param $email
     * @param $displayName
     * @param $avatar
     * @param $drumsSkillLevel
     * @param $guitarSkillLevel
     * @param $pianoSkillLevel
     */
    public function __construct(int $id, $email, $displayName, $avatar, $drumsSkillLevel, $guitarSkillLevel, $pianoSkillLevel)
    {
        $this->id = $id;
        $this->email = $email;
        $this->displayName = $displayName;
        $this->avatar = $avatar;
        $this->drumsSkillLevel = $drumsSkillLevel;
        $this->guitarSkillLevel = $guitarSkillLevel;
        $this->pianoSkillLevel  = $pianoSkillLevel;
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
     * @param mixed $id
     */
    public function setId($id)
    : void {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail()
    : string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    : void {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    : string
    {
        return $this->displayName;
    }

    /**
     * @param $displayName
     */
    public function setDisplayName($displayName)
    : void {
        $this->displayName = $displayName;
    }

    /**
     * @return string
     */
    public function getAvatar()
    : string
    {
        return $this->avatar;
    }

    /**
     * @param $avatar
     */
    public function setAvatar($avatar)
    : void {
        $this->avatar = $avatar;
    }

    /**
     * @return integer
     */
    public function getDrumsSkillLevel()
    : ?int
    {
        return $this->drumsSkillLevel;
    }

    /**
     * @param $drumsSkillLevel
     */
    public function setDrumsSkillLevel($drumsSkillLevel)
    : void {
        $this->drumsSkillLevel = $drumsSkillLevel;
    }

    /**
     * @return integer
     */
    public function getGuitarSkillLevel()
    : ?int
    {
        return $this->guitarSkillLevel;
    }

    /**
     * @param $guitarSkillLevel
     */
    public function setGuitarSkillLevel($guitarSkillLevel)
    : void {
        $this->guitarSkillLevel = $guitarSkillLevel;
    }

    /**
     * @return integer
     */
    public function getPianoSkillLevel()
    : ?int
    {
        return $this->pianoSkillLevel;
    }

    /**
     * @param $pianoSkillLevel
     */
    public function setPianoSkillLevel($pianoSkillLevel)
    : void {
        $this->pianoSkillLevel = $pianoSkillLevel;
    }
    /**
     * @return string
     */
    public function __toString()
    {
        /*
        method needed by UnitOfWork
        https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/cookbook/custom-mapping-types.html
        */
        return (string)$this->getId();
    }
}