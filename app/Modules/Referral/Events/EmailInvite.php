<?php

namespace App\Modules\Referral\Events;

class EmailInvite
{
    /**
     * @var string
     */
    protected $receiversEmail;

    /**
     * @var string
     */
    protected $referralLink;

    /**
     * @var string
     */
    private $brand;

    /**
     * EmailInvite constructor.
     */
    public function __construct(string $receiversEmail, string $referralLink, string $brand)
    {
        $this->receiversEmail = $receiversEmail;
        $this->referralLink = $referralLink;
        $this->brand = $brand;
    }

    public function getReceiversEmail(): string
    {
        return $this->receiversEmail;
    }

    public function getReferralLink(): string
    {
        return $this->referralLink;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }
}
