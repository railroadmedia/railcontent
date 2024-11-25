<?php

namespace App\Http\Controllers\Musora;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarketingController extends BaseController
{
    public function homepage(): View
    {
        return view('musora.sales.subscription', [
            'theme' => 'musora',
            'fullSubscriptionVersion' => true,
        ]);
    }
    public function trial(): View
    {
        return view('musora.sales.trial', [
            'theme' => 'musora',
            'commercialHeader' => true,
            'promoVersion' => true,
            'trialVersion' => true,
            'scrollToJoin' => true,
            'hideMenu' => true,
        ]);
    }

    public function trialMonth(): View
    {
        return view('musora.sales.subscription', [
            'theme' => 'musora',
            'scrollToJoin' => true,
            'month' => true,
        ]);
    }

    public function spotify(): View
    {
        return view('musora.sales.spotify', [
            'theme' => 'musora',
            'promoVersion' => true,
            'trialVersion' => true,
            'month' => true,
            'scrollToJoin' => true,
            'hideMenu' => true,
        ]);
    }
    public function sixReasons(): View
    {
        return view('musora.pages.6-reasons', ['theme' => 'musora', 'version' => 'musora']);
    }
    public function sixReasonsDrums(): View
    {
        return view('musora.pages.6-reasons', ['theme' => 'musora', 'version' => 'drums']);
    }
    public function sixReasonsPiano(): View
    {
        return view('musora.pages.6-reasons', ['theme' => 'musora', 'version' => 'piano']);
    }
    public function sixReasonsGuitar(): View
    {
        return view('musora.pages.6-reasons', ['theme' => 'musora', 'version' => 'guitar']);
    }
    public function sixReasonsSinging(): View
    {
        return view('musora.pages.6-reasons', ['theme' => 'musora', 'version' => 'singing']);
    }
    public function thankYou(): View
    {
        return view('musora.lead-gen.thank-you', ['theme' => 'musora']);
    }
    public function thePlaylist(): View
    {
        return view('musora.lead-gen.the-playlist', ['theme' => 'musora', 'recaptchaKey' => config('recaptcha.key')]);
    }
    public function moderators(): View
    {
        return view('musora.pages.moderators', ['theme' => 'musora']);
    }

    public function handbook(): View
    {
        return view('musora.handbook');
    }
    public function terms(): View
    {
        return view('musora.pages.terms');
    }

    public function guitarcenterTerms(): View
    {
        return view('musora.pages.redeem.guitarcenter-terms');
    }

    public function privacy(): View
    {
        return view('musora.pages.privacy');
    }

    public function preferences(): View
    {
        return view('musora.pages.preferences');
    }

    public function careers(): View
    {
        return view('musora.pages.careers');
    }

    public function careersPP(): View
    {
        return view('musora.pages.careers-pinpoint');
    }

    public function contact(): View
    {
        return view('musora.pages.contact');
    }

    public function ambassador(): View
    {
        return view('musora.pages.ambassador');
    }

    public function about(): View
    {
        return view('musora.pages.about');
    }

    public function brand(): View
    {
        return view('musora.pages.brand');
    }

    public function unified2022(): View
    {
        return view('musora.pages.unified-2022', [ 'theme' => 'musora']);
    }

    public function mentors(): View
    {
        return view('musora.pages.mentors', [ 'theme' => 'musora']);
    }

    public function playlists(): View
    {
        return view('musora.pages.playlists', [ 'theme' => 'musora']);
    }

    public function playlist(): View
    {
        return view('musora.pages.playlist', [ 'theme' => 'musora'], ['recaptchaKey' => config('recaptcha.key')]);
    }

    public function recitals(): View
    {
        return view('musora.pages.recitals');
    }

    public function giftcard(): View
    {
        return view('musora.pages.gift-card');
    }
    public function method(): View
    {
        return view('musora.pages.method', [ 'theme' => 'musora', 'page' => 'method' ]);
    }
    public function songs(): View
    {
        return view('musora.pages.songs', [ 'theme' => 'musora', 'page' => 'songs' ]);
    }
    public function community(): View
    {
        return view('musora.pages.community', [ 'theme' => 'musora', ]);
    }
    public function choosePlan(): View
    {
        return view('musora.pages.choose-plan', ['theme' => 'musora']);
    }
    public function choosePlanMonth(Request $request): View
    {
        return view('musora.pages.choose-plan', ['theme' => 'musora', 'month' => true, 'referralCode' => $request->get('referralCode')]);
    }
    public function faster(): View
    {
        return view('drumeo.lead-gen.faster.signup', ['recaptchaKey' => config('recaptcha.key')]);
    }
    public function app(): View
    {
        return view('musora.pages.app', [ 'theme' => 'musora', 'page' => 'app' ]);
    }
    public function freeMusicLessonsForLife(): View
    {
        return view('musora.pages.free-music-lessons-for-life', [ 'theme' => 'musora'], ['recaptchaKey' => config('recaptcha.key')]);
    }
    public function everyDayMusician(): View
    {
        return view('musora.pages.everyday-musician', [ 'theme' => 'musora']);
    }
    public function history(): View
    {
        return view('musora.pages.history', [ 'theme' => 'musora'], ['recaptchaKey' => config('recaptcha.key')]);
    }
    public function youtube(): View
    {
        return view('musora.pages.youtube', [ 'theme' => 'musora'], ['recaptchaKey' => config('recaptcha.key')]);
    }
    public function freeResources(): View
    {
        return view('musora.pages.free-resources', [ 'theme' => 'musora'], ['recaptchaKey' => config('recaptcha.key')]);
    }
}
