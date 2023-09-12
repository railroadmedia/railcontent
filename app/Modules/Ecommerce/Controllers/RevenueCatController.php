<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Services\RevenueCatService;
use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\Ecommerce\Services\UserProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\Ecommerce\Services\PaymentService;
use Modules\UserManagementSystem\Models\User;

class RevenueCatController extends Controller
{
    private RevenueCatService $revenueCatService;
    private SubscriptionService $subscriptionService;
    private UserProductService $userProductService;
    private PaymentService $paymentService;

    /**
     * @param RevenueCatService $revenueCatService
     * @param SubscriptionService $subscriptionService
     * @param UserProductService $userProductService
     * @param PaymentService $paymentService
     */
    public function __construct(
        RevenueCatService   $revenueCatService,
        SubscriptionService $subscriptionService,
        UserProductService  $userProductService,
        PaymentService      $paymentService
    )
    {
        $this->revenueCatService = $revenueCatService;
        $this->subscriptionService = $subscriptionService;
        $this->userProductService = $userProductService;
        $this->paymentService = $paymentService;
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
                    $data['event']['original_app_user_id'],
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

                //check if already exists Musora subscription
                $musoraSubscription = $this->getMusoraSubscription($user, $type, $musoraProduct);
                if (!$musoraSubscription) {
                    //create Musora subscription
                    $musoraSubscription = $this->subscriptionService->createSubscription(
                        $user->id,
                        $data['event']['expiration_at_ms'],
                        $musoraProduct,
                        $type,
                        $data['event']['purchased_at_ms']
                    );
                }

                if ($data['event']['period_type'] != 'TRIAL') {
                    $this->paymentService->create($musoraSubscription, $type, $data['event']['event_timestamp_ms'], $data['event']['transaction_id']);
                }

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
                    $data['event']['original_app_user_id'], true
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
                        $data['event']['expiration_at_ms'],
                        $musoraProduct->first(),
                        $type,
                        $data['event']['purchased_at_ms']
                    );
                }

                //update Musora subscription
                $this->subscriptionService->updateSubscription(
                    $musoraSubscription,
                    $data['event']['expiration_at_ms']
                );

                $this->paymentService->create($musoraSubscription, $type, $data['event']['purchased_at_ms'], $data['event']['transaction_id']);

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
                    $data['event']['original_app_user_id']
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
                    $data['event']['expiration_at_ms'],
                    $musoraProduct->first(),
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
                    $data['event']['subscriber_attributes']['email']['value'] ?? null,
                    $data['event']['original_app_user_id']
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
                        $data['event']['expiration_at_ms'],
                        $musoraProduct->first(),
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
                    $data['event']['expiration_at_ms'],
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
                $user = $this->getUser(
                    $data['event']['subscriber_attributes']['email']['value'] ?? null,
                    $data['event']['original_app_user_id']
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
                        $data['event']['expiration_at_ms'],
                        $musoraProduct->first(),
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
                    $data['event']['expiration_at_ms'],
                     null,
                    $data['event']['expiration_reason']
                );
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
    private function getUser($value = null, $appUserId, $createIfNotExists = false): ?User
    {
        $user =
            User::query()
                ->where('email', $value)
                ->orWhere('revenuecat_origin_app_user_id', $appUserId)
                ->orWhere('id', $appUserId)
                ->first();
        if (!$user && $createIfNotExists) {
            $parts = explode('@', $value);
            $user = new User;
            $user->email = $value;
            $user->setPassword($value);
            $user->display_name = $parts[0] . rand(10000, 99999);
            $user->revenuecat_origin_app_user_id = $appUserId;
            $user->save();
        } elseif ($user) {
            $user->revenuecat_origin_app_user_id = $appUserId;
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
        $store = $type . '_store';
        $isTrialConversion = array_key_exists('is_trial_conversion', $event) && $event['is_trial_conversion'];
        if ($event['period_type'] == 'TRIAL' || $isTrialConversion) {
            $productsMap = [config('ecommerce.' . $store . '_products_map_trial')[$productId]];
        } else {
            $productsMap = [config('ecommerce.' . $store . '_products_map')[$productId]];
        }

        if ($event['type'] != 'INITIAL_PURCHASE' && !$isTrialConversion) {
            $productsMap = array_merge(
                [config('ecommerce.' . $store . '_products_map')[$productId]],
                [config('ecommerce.' . $store . '_products_map_trial')[$productId]]);
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
    private function getProductId($productId1): string
    {
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
    private function getCurrentRevenueCatSubscription($appUserId, string $productId): mixed
    {
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
                ->where('type', '=', $type . '_subscription')
                ->whereIn(
                    'product_id',
                    $musoraProducts->pluck('id')
                        ->toArray()
                )
                ->first();

        return $musoraSubscription;
    }

    public function syncSubscriber(Request $request)
    {
        $user = $this->getUser(
            null,
            $request->get('original_app_user_id')
        );

        $subscriber = $this->revenueCatService->getSubscriber($request->get('original_app_user_id'));
        $entitlements = $subscriber->entitlements;
        $subscriptions = $subscriber->subscriptions;

        $active = false;
        if (!empty($entitlements)) {
            foreach ($entitlements as $entitlement) {
                $productIdentifier = $entitlement->product_identifier;
                $subscriptionData = $subscriptions->$productIdentifier;
                if (Carbon::parse($subscriptionData->expires_date) >= now()->subDays(5)) {
                    $active = true;
                }
                $type = (strtolower($subscriptionData->store) == 'app_store') ? 'apple' : 'google';
                $store = $type . '_store';
                $productsMap = array_merge(
                    [config('ecommerce.' . $store . '_products_map')[$productIdentifier]],
                    [config('ecommerce.' . $store . '_products_map_trial')[$productIdentifier]]);

                $musoraProduct =
                    Product::whereIn('sku', $productsMap)
                        ->get();
                if ($user) {
                    $userId = $user->id;
                    $musoraSubscription =
                        Subscription::query()
                            ->where('user_id', '=', $userId)
                            ->where('type', '=', $type . '_subscription')
                            ->whereIn(
                                'product_id',
                                $musoraProduct->pluck('id')
                                    ->toArray()
                            )
                            ->first();

                    if (!$musoraSubscription) {
                        $musoraSubscription = $this->subscriptionService->createSubscription(
                            $userId,
                            Carbon::parse($subscriptionData->expires_date)->getTimestampMs(),
                            $musoraProduct->first(),
                            $type,
                            Carbon::parse($subscriptionData->purchase_date)->getTimestampMs(),
                            Carbon::parse($subscriptionData->unsubscribe_detected_at)->getTimestampMs()
                        );

                        //Assign user product
                        $this->userProductService->assignUserProduct($userId, $musoraSubscription->product_id, $musoraSubscription->paid_until);
                    } else {
                        //update subscription
                        $this->subscriptionService->updateSubscription(
                            $musoraSubscription,
                            Carbon::parse($subscriptionData->expires_date)->getTimestampMs(),
                            Carbon::parse($subscriptionData->unsubscribe_detected_at)->getTimestampMs()
                        );
                        //update user product
                        $this->userProductService->assignUserProduct($userId, $musoraSubscription->product_id, $musoraSubscription->paid_until);
                    }
                }
            }
        }

        if (!$user && $active) {
            return response()->json([
                'shouldCreateAccount' => true,
            ]);
        }

        if (\user() && \user()->id !== $userId) {
            return response()->json([
                'shouldLogin' => true,
                'email' => $user->email,
            ]);
        } else if (\user()) {
            $token = $user->createToken('');
            $user->withAccessToken($token);

            return response()->json([
                'success' => true,
                'token' => $token->plainTextToken,
                'tokenType' => 'bearer',
                'userId' => $user->id,
            ]);
        }
    }
}
