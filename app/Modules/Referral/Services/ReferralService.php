<?php

namespace App\Modules\Referral\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Modules\Referral\Exceptions\ReferralException;
use App\Modules\Referral\Exceptions\SaasquatchException;
use App\Modules\Referral\Models\Referrer;
use App\Modules\Referral\Models\ReferralContact;
use Throwable;

class ReferralService
{
    /**
     * @var SaasquatchService
     */
    private $saasquatchService;

    /**
     * ReferralService constructor.
     *
     * @param  SaasquatchService  $saasquatchService
     */
    public function __construct(SaasquatchService $saasquatchService)
    {
        $this->saasquatchService = $saasquatchService;
    }

    public function getReferralsPerUser()
    {
        return config('referral.referrals_per_user');
    }

    /**
     * @param  Referrer  $referrer
     *
     * @return bool
     */
    public function canRefer(Referrer $referrer): bool
    {
        return $referrer->referrals_performed < $this->getReferralsPerUser();
    }

    /**
     * @param  int  $userId
     * @param  string  $referralProgramId
     *
     * @return Referrer
     *
     * @throws Exception
     */
    public function getReferrer(int $userId, string $referralProgramId, string $brand): ?Referrer
    {
        /**
         * @var $referrer Referrer
         */
        $referrer = Referrer::query()->where(
            [
                'user_id' => $userId,
                'referral_program_id' => $referralProgramId,
                'brand' => $brand
            ]
        )->first();

        return $referrer;
    }

    /**
     * @param  int  $userId
     * @param  string  $referralProgramId
     * @param  string $brand
     * @return Referrer
     */
    public function getOrCreateReferrer(int $userId, string $referralProgramId, string $brand): Referrer
    {
        $referrer = $this->getReferrer($userId, $referralProgramId, $brand);
        if (is_null($referrer)) {
            $referrer = $this->createReferrer($userId, $brand);
        }

        return $referrer;
    }

    /**
     * @param  int  $userId
     * @return Referrer
     * @throws ReferralException
     * @throws SaasquatchException
     * @throws Throwable
     */
    public function createReferrer(int $userId, $brand): Referrer
    {
        $saasquatchUser = $this->saasquatchService->createOrGetUser($userId, $brand);

        $referrer = new Referrer();

        $referrer->user_id = $userId;
        $referrer->referral_program_id = $saasquatchUser->getReferralProgramId();
        $referrer->referral_code = $saasquatchUser->getReferralCode();
        $referrer->referral_link = $saasquatchUser->getReferralLink();
        $referrer->referrals_performed = 0;
        $referrer->brand = $brand;

        $referrer->setCreatedAt(Carbon::now());
        $referrer->setUpdatedAt(Carbon::now());

        $referrer->saveOrFail();

        return $referrer;
    }

    /**
     * Validate if an email exists and has an active membership.
     *
     * @param string $email
     * @return array
     */
    public function validateEmail(string $email): array
    {
        $dateThreshold = Carbon::now()->subDays(120);
        
        $user = ReferralContact::where('email', $email)->first();
        
        $exists = $user !== null;
        $active = $exists && $user->membership_expiration_date > $dateThreshold;
        
        return [
            'exists' => $exists,
            'active' => $active,
        ];
    }
}
