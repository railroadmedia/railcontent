<?php

namespace App\Http\Controllers\Musora;

use App\Http\Controllers\BaseController;
use App\Modules\Ecommerce\Services\AccessCodeService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSendTransactionalEmail;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoTriggerEvent;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SalesController extends BaseController
{
    private AccessCodeService $accessCodeService;

    public function __construct(AccessCodeService $accessCodeService)
    {
        $this->accessCodeService = $accessCodeService;
    }

    public function claimSpotify(Request $request): JsonResponse
    {
        // create access code
        $accessCode = $this->accessCodeService->generateAccessCode(
            [491],
            'musora',
            'spotify-thinkific-30-day-promo'
        );

        // create the customer and send the email
        dispatch(
            (new CustomerIoSendTransactionalEmail(
                'musora',
                2,
                $request->get('email'),
                ['access_code' => strtoupper($this->accessCodeService->hyphenateCode($accessCode->code))]
            ))
                ->onConnection(config('event-data-synchronizer.customer_io_queue_connection_name', 'database'))
                ->onQueue(config('event-data-synchronizer.customer_io_queue_name', 'customer_io'))
                ->delay(Carbon::now()->addSeconds(3))
        );

        // dispatch the event
        dispatch(
            (new CustomerIoTriggerEvent(
                'musora',
                $request->get('email'),
                null,
                'musora_onboarding_spotify-trial',
                null
            ))
                ->onConnection(config('event-data-synchronizer.customer_io_queue_connection_name', 'database'))
                ->onQueue(config('event-data-synchronizer.customer_io_queue_name', 'customer_io'))
                ->delay(Carbon::now()->addSeconds(10))
        );

        return response()->json(['success' => true]);
    }
}
