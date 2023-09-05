<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Services\RevenueCatService;
use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\Ecommerce\Services\UserProductService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class RevenueCatController extends Controller
{
    private RevenueCatService $revenueCatService;
    private SubscriptionService $subscriptionService;
    private UserProductService $userProductService;

    /**
     * @param RevenueCatService $revenueCatService
     * @param SubscriptionService $subscriptionService
     * @param UserProductService $userProductService
     */
    public function __construct(
        RevenueCatService $revenueCatService,
        SubscriptionService $subscriptionService,
        UserProductService $userProductService
    ) {
        $this->revenueCatService = $revenueCatService;
        $this->subscriptionService = $subscriptionService;
        $this->userProductService = $userProductService;
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
                echo 'INITIAL_PURCHASE';

                //create new user
                $user = $this->getUser(
                    $data['event']['subscriber_attributes']['email']['value'],
                    $data['event']['app_user_id'],
                    true
                );

                //store type
                $type = (strtolower($data['event']['store']) == 'app_store') ? 'apple' : 'google';

                //productId
                $productId = $this->getProductId($data['event']['product_id']);

                //get Musora product
                $musoraProduct = $this->getMusoraProduct($type, $data['event'], $productId)->first();

                //get RevenueCat subscription
                $currentRevenueCatSubscription =
                    $this->getCurrentRevenueCatSubscription($data['event']['app_user_id'], $productId);

                //create Musora subscription
                $musoraSubscription = $this->subscriptionService->createSubscription(
                    $user->id,
                    $currentRevenueCatSubscription['expires_date'],
                    $musoraProduct,
                    $type,
                    $data['event']['purchased_at_ms']
                );

                //Assign user product
                $this->userProductService->assignUserProduct(
                    $user->id,
                    $musoraSubscription->product_id,
                    $musoraSubscription->paid_until
                );
                break;
            case 'NON_RENEWING_PURCHASE':
                echo 'NON_RENEWING_PURCHASE';
                // code...
                break;
            case 'RENEWAL':
                echo 'RENEWAL';

                // get Musora user
                $user = $this->getUser(
                    $data['event']['subscriber_attributes']['email']['value'],
                    $data['event']['app_user_id']
                );
                if (!$user) {
                    //TBD
                    break;
                }

                //store type
                $type = (strtolower($data['event']['store']) == 'app_store') ? 'apple' : 'google';

                //productId
                $productId = $this->getProductId($data['event']['product_id']);

                //get Musora product
                $musoraProduct = $this->getMusoraProduct($type, $data['event'], $productId);

                //get RevenueCat subscription
                $currentRevenueCatSubscription =
                    $this->getCurrentRevenueCatSubscription($data['event']['app_user_id'], $productId);

                //get Musora subscription
                $musoraSubscription = $this->getMusoraSubscription($user, $type, $musoraProduct);
                if (!$musoraSubscription) {
                    //create Musora subscription
                    $musoraSubscription = $this->subscriptionService->createSubscription(
                        $user->id,
                        $currentRevenueCatSubscription['expires_date'],
                        $musoraProduct,
                        $type,
                        $data['event']['purchased_at_ms']
                    );
                }

                //update Musora subscription
                $this->subscriptionService->updateSubscription(
                    $musoraSubscription,
                    $currentRevenueCatSubscription['expires_date']
                );

                //update user product
                $this->userProductService->assignUserProduct(
                    $user->id,
                    $musoraSubscription->product_id,
                    $musoraSubscription->paid_until
                );

                break;
            case 'PRODUCT_CHANGE':
                echo 'PRODUCT_CHANGE';
                // get Musora user
                $user = $this->getUser(
                    $data['event']['subscriber_attributes']['email']['value'],
                    $data['event']['app_user_id']
                );
                if (!$user) {
                    //TBD
                    break;
                }

                //store type
                $type = (strtolower($data['event']['store']) == 'app_store') ? 'apple' : 'google';

                //new productId
                $productId = $this->getProductId($data['event']['new_product_id']);

                //get Musora product
                $musoraProduct = $this->getMusoraProduct($type, $data['event'], $productId);

                //get RevenueCat subscription
                $currentRevenueCatSubscription =
                    $this->getCurrentRevenueCatSubscription($data['event']['app_user_id'], $productId);

                //create Musora subscription
                $musoraSubscription = $this->subscriptionService->createSubscription(
                    $user->id,
                    $currentRevenueCatSubscription['expires_date'],
                    $musoraProduct,
                    $type,
                    $data['event']['purchased_at_ms']
                );

                //Assign user product
                $this->userProductService->assignUserProduct(
                    $user->id,
                    $musoraSubscription->product_id,
                    $musoraSubscription->paid_until
                );

                // code...
                break;
            case 'CANCELLATION':
                $user = $this->getUser(
                    $data['event']['subscriber_attributes']['email']['value'],
                    $data['event']['app_user_id']
                );
                if (!$user) {
                    //TBD
                    break;
                }

                //store type
                $type = (strtolower($data['event']['store']) == 'app_store') ? 'apple' : 'google';

                //productId
                $productId = $this->getProductId($data['event']['product_id']);

                //get Musora product
                $musoraProduct = $this->getMusoraProduct($type, $data['event'], $productId);

                //get RevenueCat subscription
                $currentRevenueCatSubscription =
                    $this->getCurrentRevenueCatSubscription($data['event']['app_user_id'], $productId);

                //get Musora subscription
                $musoraSubscription = $this->getMusoraSubscription($user, $type, $musoraProduct);
                if (!$musoraSubscription) {
                    //create Musora subscription
                    $musoraSubscription = $this->subscriptionService->createSubscription(
                        $user->id,
                        $currentRevenueCatSubscription['expires_date'],
                        $musoraProduct,
                        $type,
                        $data['event']['purchased_at_ms']
                    );

                    //Assign user product
                    $this->userProductService->assignUserProduct(
                        $user->id,
                        $musoraSubscription->product_id,
                        $musoraSubscription->paid_until
                    );
                    break;
                }

                $this->subscriptionService->updateSubscription(
                    $musoraSubscription,
                    $currentRevenueCatSubscription['expires_date'],
                    $currentRevenueCatSubscription['unsubscribe_detected_at'],
                    $data['event']['cancel_reason']
                );

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

    /**
     * @param $value
     * @param $appUserId
     * @param false $createIfNotExists
     * @return User|null
     */
    private function getUser($value, $appUserId, $createIfNotExists = false)
    : ?User {
        $user =
            User::query()
                ->where('email', $value)
                ->orWhere('id', $appUserId)
                ->first();
        if (!$user && $createIfNotExists) {
            $user = new User;

            $user->email = $value;
            $user->setPassword($value);
            $user->display_name = $value;
            $user->save();
        }

        return $user;
    }

    /**
     * @param string $type
     * @param $event
     * @param mixed $productId
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    private function getMusoraProduct(string $type, $event, mixed $productId)
    {
        $store = $type.'_store';
        if ($event['period_type'] == 'TRIAL') {
            $productsMap = [config('ecommerce.'.$store.'_products_map_trial')[$productId]];
        } else {
            $productsMap = [config('ecommerce.'.$store.'_products_map')[$productId]];
        }

        if ($event['type'] != 'INITIAL_PURCHASE') {
            $productsMap = array_merge(
                [config('ecommerce.'.$store.'_products_map')[$productId]],
                [config('ecommerce.'.$store.'_products_map_trial')[$productId]]);
        }

        $musoraProduct =
            Product::whereIn('sku', $productsMap)
                ->get();

        return $musoraProduct;
    }

    /**
     * @param $productId1
     * @return string
     */
    private function getProductId($productId1)
    : string {
        $productId = $productId1;
        if (strpos($productId, ':') !== false) {
            $productId = explode(':', $productId)[0];
        }

        return $productId;
    }

    /**
     * @param $appUserId
     * @param string $productId
     * @return mixed
     * @throws \Exception
     */
    private function getCurrentRevenueCatSubscription($appUserId, string $productId)
    : mixed {
        $subscriber = $this->revenueCatService->getSubscriber($appUserId);
        $revenueCatSubscriptions = (json_decode(json_encode($subscriber->subscriptions), true));
        $currentRevenueCatSubscription = $revenueCatSubscriptions["$productId"] ?? null;

        return $currentRevenueCatSubscription;
    }

    /**
     * @param User $user
     * @param string $type
     * @param $musoraProducts
     * @return Subscription|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    private function getMusoraSubscription(User $user, string $type, $musoraProducts)
    {
        $musoraSubscription =
            Subscription::query()
                ->where('user_id', '=', $user->id)
                ->where('type', '=', $type.'_subscription')
                ->whereIn(
                    'product_id',
                    $musoraProducts->pluck('id')
                        ->toArray()
                )
                ->first();

        return $musoraSubscription;
    }
}
