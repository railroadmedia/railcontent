<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Jobs\WebhookJob;
use App\Modules\Ecommerce\Jobs\Recharge\ChargeFailedEventTrackingJob;
use App\Modules\Ecommerce\Jobs\Recharge\PaymentMethodUpdatedEventTrackingJob;
use App\Modules\Ecommerce\Jobs\Recharge\SubscriptionCancelledEventTrackingJob;
use App\Modules\Ecommerce\Jobs\Recharge\SubscriptionPausedEventTrackingJob;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class RechargeWebhookController extends Controller
{
    public function __construct()
    {
    }

    public function subscriptionPaused(Request $request): void
    {
        try {
            Log::info('Recharge subscription paused webhook received');

            $id = $this->getWebhookIdentifierOrGUID($request);
            $contents = $request->get('subscription');
            // Log::debug(var_export($contents));

            $children = [
                new SubscriptionPausedEventTrackingJob($contents),
            ];
            dispatch(new WebhookJob('Recharge-subscription-paused', $id, $contents, $children));
        } catch (Exception $e) {
            //Catch exception to prevent shopify from retrying the webhook
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }

    public function subscriptionCancelled(Request $request): void
    {
        try {
            Log::info('Recharge subscription cancelled webhook received');
            //Log::debug(print_r($request->all(), true));

            $id = $this->getWebhookIdentifierOrGUID($request);
            $contents = $request->all();
            $children = [
                new SubscriptionCancelledEventTrackingJob($contents),
            ];
            dispatch(new WebhookJob('Recharge-subscription-cancelled', $id, $contents, $children));
        } catch (Exception $e) {
            //Catch exception to prevent shopify from retrying the webhook
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }

    public function chargeFailed(Request $request): void
    {
        try {
            Log::info('Recharge charge failed webhook received');
            //Log::debug(print_r($request->all(), true));

            $id = $this->getWebhookIdentifierOrGUID($request);
            $contents = $request->all();
            $children = [
                new ChargeFailedEventTrackingJob($contents),
            ];
            dispatch(new WebhookJob('Recharge-charge-failed', $id, $contents, $children));
        } catch (Exception $e) {
            //Catch exception to prevent shopify from retrying the webhook
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }

    public function paymentMethodUpdated(Request $request): void
    {
        try {
            Log::info('Recharge payment method updated webhook received');
            // Log::debug(print_r($request->all(), true));
            // Log::debug($request->headers);

            $id = $this->getWebhookIdentifierOrGUID($request);
            $contents = $request->all();
            $children = [
                new PaymentMethodUpdatedEventTrackingJob($contents),
            ];
            dispatch(new WebhookJob('Recharge-payment-method-updated', $id, $contents, $children));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }

    private function getWebhookIdentifierOrGUID(Request $request)
    {
        return $request->header('x-recharge-request-id') ?? $request->header('X-Recharge-Request-Id') ?? uniqid('generated-');
    }
}
