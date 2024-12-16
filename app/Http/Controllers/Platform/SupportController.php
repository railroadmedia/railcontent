<?php

namespace App\Http\Controllers\Platform;

use Illuminate\View\View;
use Illuminate\Routing\Controller;

class SupportController extends Controller
{
    public function memberSupport(): View
    {
        $emailRecipient = config('mailora.' . brand() . '.support-email-address', "support@musora.com");
        $logoLink = config('mailora.' . brand() . '.logo-link');

        return view('pages.support', [
            'emailRecipient' => $emailRecipient,
            'logoLink' => $logoLink
        ]);
    }

    public function contact(): View
    {
        $emailRecipient = config('mailora.' . brand() . '.support-email-address', "support@musora.com");
        $logoLink = config('mailora.' . brand() . '.logo-link');
        $brandSenderName =  config('mailora.' . brand() . '.support-sender-name');

        return view('pages.contact', [
            'emailRecipient' => $emailRecipient,
            'logoLink' => $logoLink,
            'brandSenderName' => $brandSenderName
        ]);
    }

}
