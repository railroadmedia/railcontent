<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Services\RevenueCatService;
use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\Ecommerce\Services\UserProductService;
use Carbon\Carbon;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\Ecommerce\Services\PaymentService;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Gateways\RevenueCatGateway;

class RevenueCatController extends Controller
{
    use ValidatesRequests;

    private RevenueCatService $revenueCatService;
    private SubscriptionService $subscriptionService;
    private UserProductService $userProductService;
    private PaymentService $paymentService;

    /**
     * @param RevenueCatService $revenueCatService
     * @param SubscriptionService $subscriptionService
     * @param UserProductService $userProductService
     * @param PaymentService $paymentService
     * @param RevenueCatGateway $revenueCatGateway
     */
    public function __construct(
        RevenueCatService $revenueCatService,
        SubscriptionService $subscriptionService,
        UserProductService $userProductService,
        PaymentService $paymentService,
        RevenueCatGateway $revenueCatGateway
    ) {
        $this->revenueCatService = $revenueCatService;
        $this->subscriptionService = $subscriptionService;
        $this->userProductService = $userProductService;
        $this->paymentService = $paymentService;
        $this->revenueCatGateway = $revenueCatGateway;
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
        if (config('ecommerce.revenuecat_only') !== true) {
            Log::debug('revenuecat_only flag disabled');

            return response()->json();
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
                $user = $this->revenueCatService->getUser(
                    $data['event']['subscriber_attributes']['email']['value'] ?? null,
                    $data['event']['original_app_user_id'],
                    true
                );

                if (!$user) {
                    //TBD
                    $email = $data['event']['subscriber_attributes']['email']['value'] ?? '';
                    Log::error(
                        'RevenueCatController processNotification::INITIAL_PURCHASE - user not found email: '.
                        $email.
                        ' original_app_user_id: '.
                        $data['event']['original_app_user_id']
                    );
                    break;
                }

                //store type
                $type = (strtolower($data['event']['store']) == 'app_store') ? 'apple' : 'google';

                //productId
                $productId = $this->getProductId($data['event']['product_id']);

                //get Musora product
                $musoraProduct =
                    $this->getMusoraProduct($type, $data['event'], $productId)
                        ->first();

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
                    $this->paymentService->create(
                        $musoraSubscription,
                        $type,
                        $data['event']['event_timestamp_ms'],
                        $data['event']['transaction_id']
                    );
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
                $user = $this->revenueCatService->getUser(
                    $data['event']['subscriber_attributes']['email']['value'] ?? null,
                    $data['event']['original_app_user_id'],
                    true
                );
                if (!$user) {
                    //TBD
                    $email = $data['event']['subscriber_attributes']['email']['value'] ?? '';
                    Log::error(
                        'RevenueCatController processNotification::RENEWAL - user not found email: '.
                        $email.
                        ' original_app_user_id: '.
                        $data['event']['original_app_user_id']
                    );
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

                $this->paymentService->create(
                    $musoraSubscription,
                    $type,
                    $data['event']['purchased_at_ms'],
                    $data['event']['transaction_id']
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
                $user = $this->revenueCatService->getUser(
                    $data['event']['subscriber_attributes']['email']['value'] ?? null,
                    $data['event']['original_app_user_id']
                );
                if (!$user) {
                    //TBD
                    $email = $data['event']['subscriber_attributes']['email']['value'] ?? '';
                    Log::error(
                        'RevenueCatController processNotification::PRODUCT_CHANGE - user not found email: '.
                        $email.
                        ' original_app_user_id: '.
                        $data['event']['original_app_user_id']
                    );
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

                //check if Musora subscription for new product exists
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

                //Assign user product
                $this->userProductService->assignUserProduct(
                    $user->id,
                    $musoraSubscription->product_id,
                    $musoraSubscription->paid_until
                );

                // code...
                break;
            case 'CANCELLATION':
                $user = $this->revenueCatService->getUser(
                    $data['event']['subscriber_attributes']['email']['value'] ?? null,
                    $data['event']['original_app_user_id']
                );
                if (!$user) {
                    $email = $data['event']['subscriber_attributes']['email']['value'] ?? '';
                    Log::error(
                        'RevenueCatController processNotification::CANCELLATION - user not found email: '.
                        $email.
                        ' original_app_user_id: '.
                        $data['event']['original_app_user_id']
                    );
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
                    (isset($currentRevenueCatSubscription['expires_date'])) ?
                        Carbon::create($currentRevenueCatSubscription['expires_date'])
                            ->getTimestampMs() : $data['event']['expiration_at_ms'],
                    (isset($currentRevenueCatSubscription['unsubscribe_detected_at'])) ?
                        Carbon::create($currentRevenueCatSubscription['unsubscribe_detected_at'])
                            ->getTimestampMs() : null,
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
                $oldRevenueCatAppUserId = $data['event']['transferred_from'];

                foreach ($oldRevenueCatAppUserId as $key => $value) {
                    $user = $this->revenueCatService->getUser(
                        null,
                        $value
                    );
                    if ($user) {
                        $user->revenuecat_origin_app_user_id = $data['event']['transferred_to'][0];
                        $user->save();
                        continue;
                    }
                }
                break;
            case 'EXPIRATION':
                $user = $this->revenueCatService->getUser(
                    $data['event']['subscriber_attributes']['email']['value'] ?? null,
                    $data['event']['original_app_user_id']
                );
                if (!$user) {
                    $email = $data['event']['subscriber_attributes']['email']['value'] ?? '';
                    Log::error(
                        'RevenueCatController processNotification::EXPIRATION - user not found email: '.
                        $email.
                        ' original_app_user_id: '.
                        $data['event']['original_app_user_id']
                    );
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
                [config('ecommerce.'.$store.'_products_map_trial')[$productId]]
            );
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

    public function syncSubscriber(Request $request)
    {
        $user = $this->revenueCatService->syncSubscriber($request->get('original_app_user_id'), $request->get('email'));

        if (!$user) {
            return response()->json([
                                        'shouldCreateAccount' => true,
                                    ]);
        }

        if (!user() || (\user() && \user()->id !== $user->id)) {
            return response()->json([
                                        'shouldLogin' => true,
                                        'email' => $user->email,
                                    ]);
        } else {
            if (\user()) {
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function signupRevenuecat(Request $request)
    {
        $user = $this->revenueCatService->getSubscriber($request->get('original_app_user_id'));

        $subscriber = json_decode(
            json_encode((array)$user),
            true
        );

        if (!$subscriber || empty($subscriber['entitlements'])) {
            return response()->json([
                                        'shouldSignup' => true,
                                    ]);
        }

        return $this->checkSignupRestrictions($user->entitlements, $user->subscriptions, $user->original_app_user_id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function purchaseIOS(Request $request)
    {
        Log::debug('Redirect ecommerce purchase IOS to RevenueCat API:::'.$request->input('data.attributes.email'));
        Log::debug(var_export($request->all(), true));

        if (!\user()) {
            $this->validate($request, [
                                        'data.attributes.email' => 'required|email',
                                        'data.attributes.password' => 'required',
                                    ]);
        }

        $email = null;
        if (\user()) {
            $user = user();
            $email = $user->getEmail();
        }
        $revenuecatPurchase = $this->revenueCatGateway->purchase(
            $request->input('data.attributes.receipt'),
            null,
            'ios',
            $request->input('data.attributes.price'),
            $request->input('data.attributes.currency'),
            $request->has('data.attributes.app') ? $request->input('data.attributes.app') : 'Musora',
            $request->input('data.attributes.email') ?? $email,
        );

        $apiResponse = json_decode($revenuecatPurchase);
        Log::debug('RevenueCat API response');
        Log::debug(var_export($apiResponse, true));

        $user = $this->revenueCatService->syncSubscriber(
            $apiResponse->subscriber->original_app_user_id,
            $request->input('data.attributes.email') ?? $email,
            true
        );

        if (!\user()) {
            $parts = explode('@', $request->input('data.attributes.email'));
            $user->display_name = $parts[0].rand(10000, 99999);
            $user->setPassword($request->input('data.attributes.password'));
            $user->save();
        }

        //update Revenuecat subscriber attribute
        $this->revenueCatGateway->updateSubscriberAttribute(
            $user->id,
            ['email' => $request->input('data.attributes.email') ?? $email],
            'ios'
        );

        $revenuecatPurchase = $this->revenueCatGateway->purchase(
            $request->input('data.attributes.receipt'),
            null,
            'ios',
            $request->input('data.attributes.price'),
            $request->input('data.attributes.currency'),
            $request->has('data.attributes.app') ? $request->input('data.attributes.app') : 'Musora',
            $request->input('data.attributes.email') ?? $email,
            $user->id
        );

        $token = $user->createToken('ios');
        $user->withAccessToken($token);

        $userAuthToken = $token->plainTextToken;
        $attributes = [
            'receipt' => $request->input('data.attributes.receipt'),
            'email' => $request->input('data.attributes.email') ?? $email,
            'brand' => 'pianote',
            'valid' => true,
            'validation_error' => null,
        ];
        $response = new \stdClass();
        $data = new \stdClass();
        $data->type = 'appleReceipt';
        $data->id = $user->id;
        $data->attributes = $attributes;

        $meta = new \stdClass();
        $meta->auth_code = $userAuthToken;
        $response->data = $data;
        $response->meta = $meta;

        return response()->json($response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function purchaseGoogle(Request $request)
    {
        Log::debug('Redirect ecommerce purchase Google to RevenueCat API');
        Log::debug(var_export($request->all(), true));
        if (!\user()) {
            $this->validate($request, [
                                        'data.attributes.email' => 'required|email',
                                        'data.attributes.password' => 'required',
                                    ]);
        }

        $email = null;
        if (\user()) {
            $user = user();
            $email = $user->getEmail();
        }

        $revenuecatPurchase = $this->revenueCatGateway->purchase(
            $request->input('data.attributes.purchase_token'),
            $request->input('data.attributes.product_id'),
            'android',
            $request->input('data.attributes.price'),
            $request->input('data.attributes.currency'),
            $request->has('data.attributes.app') ? $request->input('data.attributes.app') : 'Musora',
            $request->input('data.attributes.email') ?? $email,
        );
        $apiResponse = json_decode($revenuecatPurchase);
        Log::debug('RevenueCat API response');
        Log::debug(var_export($apiResponse, true));

        $user = $this->revenueCatService->syncSubscriber(
            $apiResponse->subscriber->original_app_user_id,
            $request->input('data.attributes.email') ?? $email,
            true
        );
        if (!user()) {
            $parts = explode('@', $request->input('data.attributes.email'));
            $user->display_name = $parts[0].rand(10000, 99999);
            $user->setPassword($request->input('data.attributes.password'));
            $user->save();
        }

        //update Revenuecat subscriber attribute
        $this->revenueCatGateway->updateSubscriberAttribute(
            $user->id,
            ['email' => $request->input('data.attributes.email') ?? $email],
            'android'
        );

        $revenuecatPurchase = $this->revenueCatGateway->purchase(
            $request->input('data.attributes.purchase_token'),
            $request->input('data.attributes.product_id'),
            'android',
            $request->input('data.attributes.price'),
            $request->input('data.attributes.currency'),
            $request->has('data.attributes.app') ? $request->input('data.attributes.app') : 'Musora',
            $request->input('data.attributes.email') ?? $email,
            $user->id
        );

        $token = $user->createToken('android');
        $user->withAccessToken($token);

        $userAuthToken = $token->plainTextToken;
        $attributes = [
            'purchase_token' => $request->input('data.attributes.purchase_token'),
            'package_name' => $request->input('data.attributes.package_name'),
            'product_id' => $request->input('data.attributes.product_id'),
            'email' => $request->input('data.attributes.email') ?? $email,
            'brand' => 'pianote',
            'valid' => true,
            'validation_error' => null,
        ];
        $response = new \stdClass();
        $data = new \stdClass();
        $data->type = 'googleReceipt';
        $data->id = $user->id;
        $data->attributes = $attributes;

        $meta = new \stdClass();
        $meta->auth_code = $userAuthToken;
        $response->data = $data;
        $response->meta = $meta;

        return response()->json($response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     * @throws \Exception
     */
    public function restoreGoogle(Request $request)
    {
        Log::debug('Redirect ecommerce restore Google to RevenueCat API');
        Log::debug(var_export($request->all(), true));
        if (empty($request->get('purchases', []))) {
            return response()->json([
                                        'shouldSignup' => true,
                                    ]);
        }

        foreach ($request->get('purchases') as $purchase) {
            $revenuecatPurchase = $this->revenueCatGateway->purchase(
                $purchase['purchase_token'],
                $purchase['product_id'],
                'android',
                null,
                null,
                $request->has('app') ? $request->input('app') : 'Musora',
            );
            $apiResponse = json_decode($revenuecatPurchase);
            Log::debug('RevenueCat API response');
            Log::debug(var_export($apiResponse, true));

            if (!$apiResponse) {
                return response()->json(
                    [
                        'message' => 'No valid purchases on the request',
                    ],
                    422
                );
            }
            $user = $this->revenueCatService->syncSubscriber(
                $apiResponse->subscriber->original_app_user_id,
                null,
                false
            );

            if ($user) {
                if (user() && $user->id == user()->id) {
                    $token = $user->createToken('android');
                    $userAuthToken = $token->plainTextToken;

                    return response()->json([
                                                'success' => true,
                                                'token' => $userAuthToken,
                                                'tokenType' => 'bearer',
                                                'userId' => $user->id,
                                            ]);
                }

                return response()->json([
                                            'shouldLogin' => true,
                                            'email' => $user->email,
                                        ]);
            } else {
                return response()->json([
                                            'shouldCreateAccount' => true,
                                            'purchase' => $purchase,
                                        ]);
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function restoreIOS(Request $request)
    {
        Log::debug('Redirect ecommerce restore IOS to RevenueCat API');
        Log::debug(var_export($request->all(), true));

        $receipt = $request->get('receipt', []);
        if (empty($receipt)) {
            return response()->json([
                                        'shouldSignup' => true,
                                    ]);
        }
        $revenuecatPurchase = $this->revenueCatGateway->purchase(
            $receipt,
            null,
            'ios',
            null,
            null,
            $request->has('app') ? $request->input('app') : 'Musora',
        );
        $apiResponse = json_decode($revenuecatPurchase);

        Log::debug('RevenueCat API response');
        Log::debug(var_export($apiResponse, true));

        if (!$apiResponse) {
            return response()->json([
                                        'shouldSignup' => true,
                                    ]);
        }

        $user = $this->revenueCatService->syncSubscriber(
            $apiResponse->subscriber->original_app_user_id,
            null,
            false
        );
        if ($user) {
            if (user() && $user->id == user()->id) {
                $token = $user->createToken('ios');
                $userAuthToken = $token->plainTextToken;

                return response()->json([
                                            'success' => true,
                                            'token' => $userAuthToken,
                                            'tokenType' => 'bearer',
                                            'userId' => $user->id,
                                        ]);
            }

            return response()->json([
                                        'shouldLogin' => true,
                                        'email' => $user->email,
                                    ]);
        } else {
            return response()->json([
                                        'shouldCreateAccount' => true,
                                    ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function signupIOS(Request $request)
    {
        Log::info('Attempting to apple signup for receipt: '.$request->get('receipt'));
        $receipt = $request->get('receipt', []);
        if (empty($receipt)) {
            return response()->json([
                                        'shouldSignup' => true,
                                    ]);
        }
        $revenuecatPurchase = $this->revenueCatGateway->purchase(
            $receipt,
            null,
            'ios',
            null,
            null,
            $request->has('app') ? $request->input('app') : 'Musora',
        );
        $apiResponse = json_decode($revenuecatPurchase);

        Log::debug('RevenueCat API response');
        Log::debug(var_export($apiResponse, true));

        if (!$apiResponse || !$apiResponse->subscriber || empty($apiResponse->subscriber->entitlements)) {
            return response()->json([
                                        'shouldSignup' => true,
                                    ]);
        }
        $entitlements = $apiResponse->subscriber->entitlements;

        return $this->checkSignupRestrictions(
            $entitlements,
            $apiResponse->subscriber->subscriptions,
            $apiResponse->subscriber->original_app_user_id
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signupGoogle(Request $request)
    {
        Log::info('Attempting to google signup  ');
        $receipt = $request->get('purchases', []);
        if (empty($receipt)) {
            return response()->json([
                                        'shouldSignup' => true,
                                    ]);
        }

        $active = false;
        foreach ($receipt as $purchaseItem) {
            $revenuecatPurchase = $this->revenueCatGateway->purchase(
                $purchaseItem['purchase_token'],
                $purchaseItem['product_id'],
                'android',
                null,
                null,
                $request->has('app') ? $request->input('app') : 'Musora',
            );
            $apiResponse = json_decode($revenuecatPurchase);

            Log::debug('RevenueCat API response');
            Log::debug(var_export($apiResponse, true));

            if (!$apiResponse || !$apiResponse->subscriber || empty($apiResponse->subscriber->entitlements)) {
                return response()->json([
                                            'shouldSignup' => true,
                                        ]);
            }
            $entitlements = $apiResponse->subscriber->entitlements;

            foreach ($entitlements as $entitlement) {
                if (Carbon::parse($entitlement->expires_date) >= now()->subDays(config(
                                                                                    'ecommerce.days_before_access_revoked_after_expiry_in_app_purchases_only',
                                                                                    7
                                                                                ))) {
                    $active = true;
                    $subscription = $apiResponse->subscriber->subscriptions->{$entitlement->product_identifier};
                    $store = (strtolower($subscription->store) == 'app_store') ? 'apple_store' : 'google_store';

                    //productId
                    $productId = $entitlement->product_identifier;
                    $productsMap = array_merge([config('ecommerce.'.$store.'_products_map')[$productId]],
                                               [config('ecommerce.'.$store.'_products_map_trial')[$productId]]);

                    $musoraProduct =
                        Product::whereIn('sku', $productsMap)
                            ->first();

                    return response()->json([
                                                'shouldLogin' => true,
                                                'message' => 'You have an active '.
                                                    ucfirst($musoraProduct->brand ?? config('ecommerce.brand')).
                                                    ' account. Please login into your account. If you want to modify your payment plan please cancel your active subscription from device settings before.',
                                            ]);
                }
            }
        }

        if (!$active) {
            return response()->json([
                                        'shouldRenew' => true,
                                        'message' => 'You can not create multiple '.
                                            ucfirst(config('ecommerce.brand')).
                                            ' accounts under the same apple account. You already have an expired/cancelled membership. Please renew your membership.',
                                    ]);
        }

        return response()->json([
                                    'shouldSignup' => true,
                                ]);
    }

    /**
     * @param $entitlements
     * @param $subscriptions
     * @return \Illuminate\Http\JsonResponse
     */
    private function checkSignupRestrictions($entitlements, $subscriptions, $revenuecatUserId)
    : \Illuminate\Http\JsonResponse {
        $active = false;

        foreach ($entitlements as $entitlement) {
            if (Carbon::parse($entitlement->expires_date) >= now()->subDays(config(
                                                                                'ecommerce.days_before_access_revoked_after_expiry_in_app_purchases_only',
                                                                                7
                                                                            ))) {
                $active = true;
                $subscription = $subscriptions->{$entitlement->product_identifier};
                $store = (strtolower($subscription->store) == 'app_store') ? 'apple_store' : 'google_store';

                //productId
                $productId = $entitlement->product_identifier;
                $productsMap = array_merge([config('ecommerce.'.$store.'_products_map')[$productId]],
                                           [config('ecommerce.'.$store.'_products_map_trial')[$productId]]);

                $musoraProduct =
                    Product::whereIn('sku', $productsMap)
                        ->first();
                $musoraUser = $this->revenueCatService->getUser(null, $revenuecatUserId);

                if ($musoraUser) {
                    return response()->json([
                                                'shouldLogin' => true,
                                                'message' => 'You have an active '.
                                                    ucfirst($musoraProduct->brand ?? config('ecommerce.brand')).
                                                    ' account. Please login into your account. If you want to modify your payment plan please cancel your active subscription from device settings before.',
                                                'email' => $musoraUser->getEmail(),
                                            ]);
                } else {
                    return response()->json([
                                                'shouldSignup' => true,
                                            ]);
                }
            }
        }

        if (!$active) {
            $musoraUser = $this->revenueCatService->getUser(null, $revenuecatUserId);
            if ($musoraUser) {
                return response()->json([
                                            'shouldRenew' => true,
                                            'message' => 'You can not create multiple '.
                                                ucfirst(config('ecommerce.brand')).
                                                ' accounts under the same apple account. You already have an expired/cancelled membership. Please renew your membership.',
                                            'email' => $musoraUser->getEmail(),
                                        ]);
            }else {
                return response()->json([
                                            'shouldSignup' => true,
                                        ]);
            }
        }

        return response()->json([
                                    'shouldSignup' => true,
                                ]);
    }
}
