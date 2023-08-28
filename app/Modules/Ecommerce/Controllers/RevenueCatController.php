<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\Ecommerce\Services\RevenueCatService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class RevenueCatController extends Controller
{
    private RevenueCatService $revenueCatService;

    /**
     * @param RevenueCatService $revenueCatService
     */
    public function __construct(RevenueCatService $revenueCatService)
    {
        $this->revenueCatService = $revenueCatService;
    }

    public function processNotification(Request $request)
    {
        Log::debug('Processing RevenueCatController processNotification');
        Log::debug(var_export($request->all(), true));

        if (config('ecommerce.revenuecat_webhook_token') &&
            (!$request->bearerToken() || $request->bearerToken() != config('ecommerce.revenuecat_webhook_token'))) {
            Log::debug('Invalid token');

            return response()->json('Invalid token');
        }

        if (!$request->has('event')) {
            return response()->json();
        }
        $data = $request->all();
        $eventType = $data['event']['type'];

        switch ($eventType) {
            case 'TEST':
                echo 'Test OK';
                break;
            case 'INITIAL_PURCHASE':
                // code...
                echo 'INITIAL_PURCHASE';
                //                $subscriber = $this->revenueCatService->getSubscriber($data['event']['app_user_id']);
                // dd($data['event']['aliases']);
                //
                // dd($subscriber);
                break;
            case 'NON_RENEWING_PURCHASE':
                echo 'NON_RENEWING_PURCHASE';
                // code...
                break;
            case 'RENEWAL':
                $subscriber = $this->revenueCatService->getSubscriber($data['event']['app_user_id']);
                $user =
                    User::query()
                        ->whereIn('id', $data['event']['aliases'])
                        ->first();

                $revenueCatSubscriptions = (json_decode(json_encode($subscriber->subscriptions), true));
                $productId = $data['event']['product_id'];

                $store = (strtolower($data['event']['store']) == 'app_store') ? 'apple_store' : 'google_store';

                $productsMap =
                    array_merge(
                        [config('ecommerce.'.$store.'_products_map')[$productId]],
                        [config('ecommerce.'.$store.'_products_map_trial')[$productId]]
                    );

                $currentRevenueCatSubscription = $revenueCatSubscriptions["$productId"];
                $musoraProducts =
                    Product::whereIn('sku', $productsMap)
                        ->get();

                $musoraSubscription =
                    Subscription::query()
                        ->where('user_id', '=', $user->id)
                        ->whereIn(
                            'product_id',
                            $musoraProducts->pluck('id')
                                ->toArray()
                        )
                        ->first();

                $musoraSubscription->is_active = $currentRevenueCatSubscription['expires_date'] > Carbon::now();
                $musoraSubscription->paid_until = Carbon::parse($currentRevenueCatSubscription['expires_date']);
                $musoraSubscription->apple_expiration_date =
                    Carbon::parse($currentRevenueCatSubscription['expires_date']);

                $musoraSubscription->save();

                UserProduct::query()->where('user_id', $user->id)
                    ->where('product_id', $musoraSubscription->product_id)
                    ->update([
                        'expiration_date' => $musoraSubscription->paid_until->addDays(config('ecommerce.days_before_access_revoked_after_expiry_in_app_purchases_only', 5))
                             ]);
                echo 'RENEWAL subscription updated id::'.$musoraSubscription->id;
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
