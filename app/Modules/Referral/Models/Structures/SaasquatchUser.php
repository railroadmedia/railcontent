<?php

namespace App\Modules\Referral\Models\Structures;

class SaasquatchUser
{
    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $referralProgramId;

    /**
     * @var string
     */
    private $referralCode;

    /**
     * @var string
     */
    private $referralLink;

    /**
     * @var string
     */
    private $brand;

    public function __construct($userId, $referralProgramId, $referralCode, $referralLink, $brand)
    {
        $this->userId = $userId;
        $this->referralProgramId = $referralProgramId;
        $this->referralCode = $referralCode;
        $this->referralLink = $referralLink;
        $this->brand = $brand;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getReferralProgramId(): string
    {
        return $this->referralProgramId[$this->brand];
    }

    public function getReferralCode(): string
    {
        return $this->referralCode;
    }

    public function getReferralLink(): string
    {
        return $this->referralLink;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }


}
