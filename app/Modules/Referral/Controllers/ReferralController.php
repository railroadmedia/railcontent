<?php

namespace App\Modules\Referral\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use App\Modules\Referral\Events\EmailInvite;
use App\Modules\Referral\Requests\EmailInviteRequest;
use App\Modules\Referral\Services\ReferralService;

class ReferralController extends Controller
{
    private ReferralService $referralService;

    /**
     * @param  ReferralService  $referralService
     */
    public function __construct(
        ReferralService $referralService,
    ) {
        $this->referralService = $referralService;
    }

    /**
     * @param  EmailInviteRequest  $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function emailInvite(EmailInviteRequest $request)
    {
        $brand = $request->get('brand');
        $referrer = $this->referralService->getOrCreateReferrer(
            user()->id,
            config('referral.saasquatch_referral_program_id.' . $brand),
            $brand
        );

        if (!$this->referralService->canRefer($referrer)) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['email-invite-message' => config('referral.messages.email_invite_fail')]);
        }

        // this event is used in other packages to actually send the email
        event(new EmailInvite($request->get('email'), $referrer->referral_link, $brand));

        $redirect = $request->has('redirect') ? $request->get('redirect') : url()->route(
            config('referral.email_invite_redirect_route'),
            ['brand' => $request->get('brand')]
        );

        // this endpoint can handle json requests for the mobile app as well
        if ($request->isJson()) {
            return response()
                ->json(['success' => true, 'email-invite-message' => config('referral.messages.email_invite_success')]);
        }

        return redirect()
            ->away($redirect)
            ->with(['email-invite-message' => config('referral.messages.email_invite_success')]);
    }

}
