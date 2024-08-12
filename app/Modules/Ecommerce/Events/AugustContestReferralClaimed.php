<?php

namespace App\Modules\Ecommerce\Events;

use App\Modules\Referral\Models\Referrer;

class AugustContestReferralClaimed
{
    private Referrer $referrer;
    private int $productId;
    private int $userId;

    /**
     * ReferralClaimed constructor.
     */
    public function __construct(Referrer $referrer, int $productId, int $userId)
    {
        $this->referrer = $referrer;
        $this->productId = $productId;
        $this->userId = $userId;
    }

    public function getReferrer(): Referrer
    {
        return $this->referrer;
    }

    public function setReferrer(Referrer $referrer): void
    {
        $this->referrer = $referrer;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

}
