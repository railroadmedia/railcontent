<?php

namespace App\Http\Controllers\Musora;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Railroad\Ecommerce\Services\AccessCodeService;

class CodeRedemptionController extends BaseController
{
    private AccessCodeService $accessCodeService;

    /**
     * @param AccessCodeService $accessCodeService
     */
    public function __construct(AccessCodeService $accessCodeService)
    {
        $this->accessCodeService = $accessCodeService;
    }

    public function powerPack()
    {
        return view('drumeo.sales.trials.power-pack');
    }

    public function hitLikeAGirlSubmission(Request $request)
    {
        $code = false;

        if (session()->has('claimed_hlag')) {
            return redirect()
                ->away('/power-pack#customize-anchor')
                ->withErrors(['You cannot claim another code']);
        }

        $request->validate(
            [
                'email' => 'email',
            ]
        );

        // todo: better way to prevent abuse?
        session()->push('claimed_hlag', true);

        try {
            $code = $this->accessCodeService->generateAccessCode([124], 'drumeo');
            // 124 is id for "Drumeo Edge Membership - Monthly" (sku: DLM-1-month)
        } catch (\Exception $e) {
            error_log($e);
        }

        if (!$code) {
            Mail::send(
                'emails.general',
                [
                    'user' => ['email' => 'The Drumeo server'],
                    'message' => 'An error occurred for a user tying to get a Hit-Like-A-Girl promo 1-month ' .
                        'access code. Please look up info about the user to see if maybe they\'ve tried again ' .
                        'successfully. If they haven\'t, please email them informing help on the way and then ' .
                        'development asking for a code to send them. The user\'s email is: ' .
                        $request->get('email') . ' (name: ' . $request->get('first_name') . ' ' .
                        $request->get('last_name') . ')'
                ],
                function (\Illuminate\Mail\Message $message) use ($request) {
                    $message->from('system@drumeo.com', 'Drumeo');
                    $message->to('support@drumeo.com')->subject('[Drumeo Edge] Your Free 30-Day Access Code');
                }
            );
            return redirect()->away('/power-pack#customize-anchor')->with(['error' => true]);
        }

        Mail::send(
            'emails.hit-like-a-girl-free-code-delivery',
            [
                'code' => $code->getCode(),
                'firstName' => $request->get('first_name'),
                'lastName' => $request->get('last_name'),
            ],
            function (\Illuminate\Mail\Message $message) use ($request) {
                $message->from('support@drumeo.com', 'Drumeo');
                $message->to($request->get('email'))
                    ->subject('[Drumeo Edge] Your Free 30-Day Access Code');
            }
        );

        return redirect()
            ->away('/power-pack#customize-anchor')
            ->with(['success' => 'Your code has been sent to your email!']);
    }

    public function renderNewAccountRedeemPage()
    {
        return view('musora.pages.redeem.card-redeem-theme', ['newAccount' => true]);
    }

    public function renderNewAccountThomannRedeemPage()
    {
        return view('musora.pages.redeem.thomann-redeem-theme', ['newAccount' => true]);
    }

    public function renderExistingAccountRedeemPage()
    {
        return view('musora.pages.redeem.card-redeem-theme', ['newAccount' => false]);
    }

    public function roland()
    {
        return view('pianote.sales.roland', ['redirectUrl' => get_musora_brand_base_url() . '/pianote']);
    }

    public function sonor()
    {
        return view('drumeo.sales.trials.sonor', ['redirectUrl' => get_musora_brand_base_url() . '/drumeo']);
    }

    public function showPianoteRedeemPageForNewUsers()
    {
        return view(
            'musora.pages.redeem.access-code-redeem-page',
            ['newAccount' => true, 'redirectUrl' => get_musora_brand_base_url() . '/pianote']
        );
    }

    public function showPianoteRedeemPageForExistingUsers()
    {
        return view(
            'musora.pages.redeem.access-code-redeem-page',
            ['newAccount' => false, 'redirectUrl' => get_musora_brand_base_url() . '/pianote']
        );
    }
}
