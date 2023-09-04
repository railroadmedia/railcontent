<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\Ecommerce\Services\RevenueCatService;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Events\UserProducts\UserProductCreated;
use Railroad\Ecommerce\Events\UserProducts\UserProductUpdated;
use Railroad\Ecommerce\Repositories\UserProductRepository;

class RevenueCatController extends Controller
{
    private RevenueCatService $revenueCatService;
    private UserProductRepository $userProductRepository;
    private UserMembershipFieldsService $userMembershipFieldsService;

    /**
     * @param RevenueCatService $revenueCatService
     * @param UserProductRepository $userProductRepository
     * @param UserMembershipFieldsService $userMembershipFieldsService
     */
    public function __construct(
        RevenueCatService $revenueCatService,
        UserProductRepository $userProductRepository,
        UserMembershipFieldsService $userMembershipFieldsService
    ) {
        $this->revenueCatService = $revenueCatService;
        $this->userProductRepository = $userProductRepository;
        $this->userMembershipFieldsService = $userMembershipFieldsService;
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
                $user = $this->getUser($data['event']['subscriber_attributes']['email']['value'], true);

                //store type
                $type = (strtolower($data['event']['store']) == 'app_store') ? 'apple' : 'google';

                //productId
                $productId = $this->getProductId($data['event']['product_id']);

                //get Musora product
                $musoraProduct = $this->getMusoraProduct($type, $data['event'], $productId);

                //get RevenueCat subscription
                $currentRevenueCatSubscription =
                    $this->getCurrentRevenueCatSubscription($data['event']['app_user_id'], $productId);

                //create Musora subscription
                $musoraSubscription = $this->createMusoraSubscription(
                    $user,
                    $currentRevenueCatSubscription['expires_date'],
                    $musoraProduct,
                    $type,
                    $data['event']['purchased_at_ms']
                );

                //Assign user product
                $this->createUserProduct($user, $musoraProduct, $musoraSubscription);

                break;
            case 'NON_RENEWING_PURCHASE':
                echo 'NON_RENEWING_PURCHASE';
                // code...
                break;
            case 'RENEWAL':
                echo 'RENEWAL';

                // get Musora user
                $user = $this->getUser($data['event']['subscriber_attributes']['email']['value']);
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
                    //TBD
                    break;
                }

                //update Musora subscription
                $musoraSubscription->is_active = $currentRevenueCatSubscription['expires_date'] > Carbon::now();
                $musoraSubscription->paid_until = Carbon::parse($currentRevenueCatSubscription['expires_date']);
                $musoraSubscription->apple_expiration_date =
                    Carbon::parse($currentRevenueCatSubscription['expires_date']);
                $musoraSubscription->total_cycles_paid = $musoraSubscription->total_cycles_paid + 1;
                $musoraSubscription->canceled_on = null;
                $musoraSubscription->cancellation_reason = null;

                $musoraSubscription->save();

                //update user product
                $this->updateUserProduct($user, $musoraSubscription);

                break;
            case 'PRODUCT_CHANGE':
                echo 'PRODUCT_CHANGE';
              //  dd($this->revenueCatService->getSubscriber('$RCAnonymousID:2e1585a377a14fa49af61b92782b1eb6'));
                // get Musora user
                $user = $this->getUser($data['event']['subscriber_attributes']['email']['value']);
                if (!$user) {
                    //TBD
                    break;
                }

                //store type
                $type = (strtolower($data['event']['store']) == 'app_store') ? 'apple' : 'google';

                //productId
                $productId = $this->getProductId($data['event']['new_product_id']);

                //get Musora product
                $musoraProduct = $this->getMusoraProduct($type, $data['event'], $productId);

                //get RevenueCat subscription
                $currentRevenueCatSubscription =
                    $this->getCurrentRevenueCatSubscription($data['event']['app_user_id'], $productId);

                //create Musora subscription
                $musoraSubscription = $this->createMusoraSubscription(
                    $user,
                    $currentRevenueCatSubscription['expires_date'],
                    $musoraProduct,
                    $type,
                    $data['event']['purchased_at_ms']
                );

                //Assign user product
                $this->createUserProduct($user, $musoraProduct, $musoraSubscription);

                // code...
                break;
            case 'CANCELLATION':
                $user = $this->getUser($data['event']['subscriber_attributes']['email']['value']);
                if (!$user) {
                    //TBD
                    break;
                }

                $productId = $this->getProductId($data['event']['product_id']);

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
                    //TBD
                    break;
                }

                //update Musora subscription
                $musoraSubscription->is_active = $currentRevenueCatSubscription['expires_date'] > Carbon::now();
                $musoraSubscription->canceled_on =
                    Carbon::parse($currentRevenueCatSubscription['unsubscribe_detected_at']);
                $musoraSubscription->cancellation_reason = $data['event']['cancel_reason'];
                $musoraSubscription->save();

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
     * @return User
     */
    private function getUser($value, $createIfNotExists = false)
    : ?User {
        $user =
            User::query()
                ->where('email', $value)
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
     * @param User $user
     * @param $expiresDate
     * @param $musoraProduct
     * @param string $type
     * @param $purchasedAtMs
     * @return Subscription
     */
    private function createMusoraSubscription(
        User $user,
        $expiresDate,
        $musoraProduct,
        string $type,
        $purchasedAtMs
    )
    : Subscription {
        $musoraSubscription = new Subscription();
        $musoraSubscription->user_id = $user->id;
        $musoraSubscription->is_active = $expiresDate > Carbon::now();
        $musoraSubscription->paid_until = Carbon::parse($expiresDate);
        $musoraSubscription->apple_expiration_date = Carbon::parse($expiresDate);
        $musoraSubscription->product_id = $musoraProduct->id;
        $musoraSubscription->brand = $musoraProduct->brand;
        $musoraSubscription->type = $type.'_subscription';
        $musoraSubscription->start_date =
            Carbon::parse($purchasedAtMs)
                ->toDateTimeString();
        $musoraSubscription->created_at = Carbon::now();
        $musoraSubscription->total_cycles_paid = 1;
        $musoraSubscription->stopped = false;
        $musoraSubscription->renewal_attempt = 0;
        $musoraSubscription->total_price = $musoraProduct->price;
        $musoraSubscription->canceled_on = null;
        $musoraSubscription->currency = config('ecommerce.default_currency');
        $musoraSubscription->interval_type = $musoraProduct->subscription_interval_type;
        $musoraSubscription->interval_count = $musoraProduct->subscription_interval_count;

        $musoraSubscription->total_cycles_paid = 1;

        $musoraSubscription->save();

        return $musoraSubscription;
    }

    /**
     * @param User $user
     * @param $musoraProduct
     * @param Subscription $musoraSubscription
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private function createUserProduct(
        User $user,
         $musoraProduct,
        Subscription $musoraSubscription
    )
    : void {
        $userProduct = new UserProduct();
        $userProduct->user_id = $user->id;
        $userProduct->product_id = $musoraProduct->id;
        $userProduct->quantity = 1;
        $userProduct->expiration_date = $musoraSubscription->paid_until->addDays(
            config(
                'ecommerce.days_before_access_revoked_after_expiry_in_app_purchases_only',
                5
            )
        );
        $userProduct->save();

        $userProduct = $this->userProductRepository->find($userProduct->id);
        event(new UserProductCreated($userProduct));
    }

    /**
     * @param string $type
     * @param $periodType
     * @param mixed $productId
     *
     */
    private function getMusoraProduct(string $type, $event, mixed $productId) {
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
                ->first();

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

    /**
     * @param User $user
     * @param $musoraSubscription
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private function updateUserProduct(
        User $user,
        $musoraSubscription
    )
    : void {
        $oldUserProduct =
            UserProduct::query()
                ->where('user_id', $user->id)
                ->where('product_id', $musoraSubscription->product_id)
                ->first();

        //                if (!$oldUserProduct) {
        //                    //TBD
        //                    break;
        //                }
        $oldUserProduct = $this->userProductRepository->find($oldUserProduct->id);

        UserProduct::query()
            ->where('user_id', $user->id)
            ->where('product_id', $musoraSubscription->product_id)
            ->update([
                         'expiration_date' => $musoraSubscription->paid_until->addDays(
                             config(
                                 'ecommerce.days_before_access_revoked_after_expiry_in_app_purchases_only',
                                 5
                             )
                         ),
                     ]);
        $userProduct = $this->userProductRepository->find($oldUserProduct->getId());
        event(new UserProductUpdated($userProduct, $oldUserProduct));
    }
}
