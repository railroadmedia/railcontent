<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Rules\ReCaptcha;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Modules\CustomerIO\Services\CustomerIoService;
use Illuminate\Support\Facades\Log;
use Throwable;

class RevenueCatController extends Controller
{
    public function processNotification(Request $request)
    {
        Log::debug('Processing RevenueCatController processNotification');
        Log::debug(var_export($request->all(), true));

        if (!$request->has('event')) {
            return response()->json();
        }
        $data = $request->all();
        $eventType = $data['event']['type'];

        switch ($eventType) {
            case 'TEST':
                echo '⚠️Test OK';
                break;
            case 'INITIAL_PURCHASE':
                // code...
                echo 'INITIAL_PURCHASE';
                break;
            case 'NON_RENEWING_PURCHASE':
                echo 'NON_RENEWING_PURCHASE';
                // code...
                break;
            case 'RENEWAL':
                echo 'RENEWAL';
                // code...
                break;
            case 'PRODUCT_CHANGE':
                echo 'PRODUCT_CHANGE';
                // code...
                break;
            case 'CANCELLATION':
                // code...
                break;
            case 'BILLING_ISSUE':
                // code...
                break;
            case 'SUBSCRIBER_ALIAS':
                // code...
                break;
            case 'SUBSCRIPTION_PAUSED':
                // code...
                break;
            case 'TRANSFER':
                // code...
                break;
            case 'EXPIRATION':
                // code...
                break;
            // handle other events..
            default:
                // code...
                break;
        }

        return response()->json();
    }
}
