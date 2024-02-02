<?php

namespace Modules\UserManagementSystem\Controllers;

use App\Modules\Ecommerce\Models\Product;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Log;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Events\User\UserDeleted;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Modules\UserManagementSystem\Models\ReportedUser;
use Modules\UserManagementSystem\Models\BlockedUser;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\Structures\Purchaser;
use Railroad\Ecommerce\Events\AugustContestReferralClaimed;
use Railroad\Mailora\Services\MailService;
use App\Modules\Referral\Exceptions\NotFoundException;
use App\Modules\Referral\Exceptions\ReferralException;
use App\Modules\Referral\Exceptions\SaasquatchException;
use App\Modules\Referral\Exceptions\SaasquatchUserExistsException;
use App\Modules\Referral\Models\Referrer;
use App\Modules\Referral\Services\SaasquatchService;
use Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    use ValidatesRequests;
    use AuthorizesRequests;

    private MailService $mailService;
    private SaasquatchService $saasquatchService;
    private UserService $userService;

    /**
     * UserController constructor.
     */
    public function __construct(
        MailService $mailService,
        SaasquatchService $saasquatchService,
        UserService $userService
    ) {
        $this->mailService = $mailService;
        $this->saasquatchService = $saasquatchService;
        $this->userService = $userService;
        $this->middleware([ConvertEmptyStringsToNull::class]);
    }

    /**
     * @throws SaasquatchUserExistsException
     * @throws ReferralException
     * @throws SaasquatchException
     * @throws NotFoundException
     * @throws Exception
     */
    private function applyReferral(string $referralCode, User $user, string $productSku): void
    {
        /**
         * @var $referrer Referrer
         */
        $referrer = Referrer::query()->where('referral_code', $referralCode)->firstOrFail();

        $brand = $referrer->brand;
        $productToAssign = Product::whereSku($productSku)->first();

        if (empty($productToAssign)) {
            throw new Exception(
                'Error assigning product to user trying to claim a referral. ' .
                'Could not find product with configured SKU, ' . $productSku
            );
        }

        // increase the referrers referral count for this program and code and add this claimers user id to the column
        $referrer->referrals_performed += 1;

        $claimedUserIds = $referrer->claimed_user_ids;
        $claimedUserIds[] = $user->id;

        $referrer->claimed_user_ids = $claimedUserIds;

        $referrer->save();

        $this->saasquatchService->applyReferralCode($user->getId(), $referrer->referral_code, $brand);

        event(new AugustContestReferralClaimed($referrer, $productToAssign->id, $user->getId()));
        info(
            "Applied referral code $referralCode for user " . $user->getId(
            ) . " and triggered event AugustContestReferralClaimed."
        );
    }

    public function createAccountPage(Request $request)
    {
        $email = $request->get('email');

        // This must be generated passed so that someone can't claim someone else's email.
        // It must be generated via md5 with the email string and special key combined.
        // md5('email' . config('shopify.multipass.account_creation_secret_key'))
        // On the shopify side, we'll generate the link to this claim page and include the key in the url params. This
        // ensures that only a person with the special link can claim that email address.

        $verificationToken = $request->get('verification_token');

        if (strtolower($verificationToken) !== strtolower(
                md5($email . config('shopify.multipass.account_creation_secret_key'))
            )) {
            throw new AuthorizationException('Invalid verification_token.', 403);
        }

        if (user() && user()->getEmail() == $email && !user()->doesRequirePasswordUpdate()) {
            return redirect()->to('/members');
        }

        $user = User::query()->where('email', $email)->first() ?? null;

        if ($user && !$user->doesRequirePasswordUpdate()) {
            Auth::logout();
            return redirect()->route('login', ['email' => $email]);
        }

        return view('pages.account-creation', ['email' => $email, 'verificationToken' => $verificationToken]);
    }

    public function createUserWithVerificationToken(Request $request)
    {
        try {
            $validationRules = [
                'email' => 'email|max:255',
                'password' => 'required|string|min:8|max:128',
            ];

            $this->validate(
                $request,
                $validationRules
            );
        } catch (ValidationException $exception) {
            return redirect()
                ->back()
                ->withErrors($exception->errors());
        }

        $email = $request->get('email');
        $password = $request->get('password');

        // This must be generated passed so that someone can't claim someone else's email.
        // It must be generated via md5 with the email string and special key combined.
        // md5('email' . config('shopify.multipass.account_creation_secret_key'))
        // On the shopify side, we'll generate the link to this claim page and include the key in the url params. This
        // ensures that only a person with the special link can claim that email address.

        $verificationToken = $request->get('verification_token');

        if (strtolower($verificationToken) !== strtolower(
                md5($email . config('shopify.multipass.account_creation_secret_key'))
            )) {
            throw new AuthorizationException('Invalid verification_token.', 403);
        }

        $user = User::where('email', $email)->first();
        if ($user) {
            $parts = explode('@', $email);

            $user->email = $email;
            $user->setPassword($password);
            $user->requires_password_update = false;
            $user->display_name = $parts[0] . rand(10000, 99999);
            $user->save();
        } else {
            $user = $this->userService->createUser($email, $password);
        }

        try {
            $referralCode = Session::pull('referral_code');
            $productSku = Session::pull('referral_code_product_sku');
            if ($referralCode && $productSku) {
                $this->applyReferral(
                    $referralCode,
                    $user,
                    $productSku,
                );
            }
        } catch (Exception $e) {
            // don't block the user from creating an account if the referral code fails
            Log::error("Error applying referral code for user $user->id: " . $e->getMessage());
        }


        Auth::loginUsingId($user->getId());

        return $request->has('redirect') ?
            redirect()
                ->away($request->get('redirect')) :
            redirect()
                ->to(config('ecommerce.post_purchase_redirect_digital_items'));
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $isJson = request()->expectsJson();
        $this->authorize('create-users');

        try {
            $validationRules = [
                'email' => 'email|max:255|unique:' .
                    config('user_management_system.database_connection_name') .
                    '.usora_users',
                'password' => 'required|string|min:8|max:128',
                'display_name' => 'required|string|max:64|min:2|unique:' .
                    config('user_management_system.database_connection_name') .
                    '.usora_users',
            ];

            $this->validate(
                $request,
                $validationRules
            );
        } catch (ValidationException $exception) {
            if ($isJson) {
                return json_encode([
                    "errors" => $exception->errors(),
                ]);
            }

            return $request->has('redirect') ?
                redirect()
                    ->away($request->get('redirect'))
                    ->with($exception->errors()) :
                redirect()
                    ->back()
                    ->with($exception->errors());
        }

        $user = new User;

        $user->email = $request->email;
        $user->setPassword($request->password);
        $user->display_name = $request->display_name;
        $user->save();

        $newUser =
            User::where('email', $user->email)
                ->first();;

        event(new UserCreated($user));

        if (!$isJson) {
            $message = ['success' => true];

            return $request->has('redirect') ?
                redirect()
                    ->away($request->get('redirect'))
                    ->with($message) :
                redirect()
                    ->back()
                    ->with($message);
        } else {
            return json_encode([
                "data" => ["attributes" => json_encode($user)],
            ]);
        }
    }

    /**
     * @param Request $request
     * @param integer $id
     */
    public function read(Request $request, $id)
    {
        //$this->authorize('show-users');
        $user = User::findOrFail($id);

        if ($user) {
            $user['shopify_customer_url'] =
                ($user->shopify_id) ?
                    'https://admin.shopify.com/store/' . config(
                        'usora.shopify_store'
                    ) . '/customers/' . $user->shopify_id :
                    '';
            $user['revenuecat_customer_url'] =
                ($user->revenuecat_origin_app_user_id) ?
                    'https://app.revenuecat.com/customers/' .
                    config('usora.revenuecat_project_id') .
                    '/' .
                    $user->revenuecat_origin_app_user_id : '';

            return json_encode([
                "data" => [
                    "id" => $user->id,
                    "type" => "user",
                    "attributes" => $user,
                ],
            ]);
        } else {
            throw new NotFoundHttpException();
        }
    }


    /**
     * @param Request $request
     * @param integer $id
     */
    public function update(Request $request, $id)
    {
        $isJson = request()->expectsJson();

        if (auth()->user()->id != $id) {
            $this->authorize('update-users');
        }
        try {
            $request->validate([
                'display_name' => [
                    Rule::unique(
                        config('user_management_system.database_connection_name') . '.usora_users'
                    )
                        ->ignore($id),
                    'string',
                    'max:64',
                    'min:2',
                ],
            ]);
        } catch (ValidationException $e) {
            $messagesByField =
                $e->validator->getMessageBag()
                    ->getMessages();
            $messagesForFieldFailingField = reset($messagesByField);

            foreach ($messagesForFieldFailingField as $messagesForField) {
                $errorMessageToUser = $messagesForField;
                break;
            }
            $default = 'Please try again, and contact support if the problem persists.';
            $message = ['error-message' => ($errorMessageToUser ?? $default)];

            if ($isJson) {
                return response()->json(['errors' => $message], 422);
            }

            return redirect()
                ->back()
                ->with($message);
        }

        $user = User::findOrFail($id);

        if (!empty($request->input('data.attributes.email'))) {
            $this->authorize('update-users-email-without-confirmation');
        }

        if (!empty($request->input('use_legacy_video_player')) && $request->get('use_legacy_video_player') == 'on') {
            $request->merge(['use_legacy_video_player' => 1]);
        }

        //todo: create exception and add error message if user is not found
        if ($user) {
            $oldUser = clone($user);

            $user->fill($request->all());
            $user->save();

            event(new UserUpdated($user, $oldUser));
        }

        if (!$isJson) {
            $message = ['success' => true];

            return $request->has('redirect') ?
                redirect()
                    ->away($request->get('redirect'))
                    ->with($message) :
                redirect()
                    ->back()
                    ->with($message);
        } else {
            return json_encode([
                "data" => ["attributes" => json_encode($user)],
            ]);
        }
    }

    /**
     * @param Request $request
     * @param integer $id
     */
    public function destroy(Request $request, $id)
    {
        $isJson = request()->expectsJson();

        $this->authorize('delete-users');

        $user = User::find($id);
        if ($user) {
            $user->delete();
            event(new UserDeleted($user));
        } else {
            return response('', 404);
        }

        if (!$isJson) {
            $message = ['success' => true];

            return $request->has('redirect') ?
                redirect()
                    ->away($request->get('redirect'))
                    ->with($message) :
                redirect()
                    ->back()
                    ->with($message);
        } else {
            return json_encode([
                "data" => ["attributes" => json_encode($user)],
            ]);
        }
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        //$this->authorize('index-users');
        $searchTerm = $request->get('search_term');
        $limit = $request->get('per_page', 25);
        $skip = ($request->get('page', 1) - 1) * $limit;


        $users =
            User::query()
                ->where('display_name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                ->orWhere('first_name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('last_name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('phone_number', 'LIKE', "%{$searchTerm}%")
                ->skip($skip)
                ->take($limit)
                ->orderBy($request->get('sort', 'createdAt'))
                ->get();
        $totalResults =
            User::query()
                ->where('display_name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                ->orWhere('first_name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('last_name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('phone_number', 'LIKE', "%{$searchTerm}%")
                ->count();
        $results = [];
        foreach ($users as $user) {
            $results[] = [
                "id" => $user->id,
                "type" => "user",
                "attributes" => $user,
            ];
        }

        return json_encode([
            "data" => $results,
            "meta" => [
                "pagination" => [
                    "total" => $totalResults,
                    "per_page" => $limit,
                    "current_page" => 1,
                    "total_pages" => ceil($totalResults / $limit),
                    "links" => [],
                ],
            ],
        ]);
    }

    public function getLogInAsUserURL(Request $request, $userId)
    {
        if (!user()->isAdmin()) {
            throw new UnauthorizedException();
        }

        /**
         * @var $user User
         */
        $user = User::findOrFail($userId);

        // they should never be able to log in as admins
        if ($user->isAdmin()) {
            throw new UnauthorizedException();
        }

        $authKey = md5($user->id . $user->password . Carbon::now()->startOfMinute()->toDateTimeString());
        $lastUsedBrand = $user->last_used_brand ?? 'drumeo';
        $logInAsUserURL = url()->route(
            'platform.profile.dashboard',
            ['brand' => $lastUsedBrand, 'userId' => $user->id, 'auth_key' => $authKey, 'user_id' => $user->id]
        );

        return response()->json(['login_in_as_user_url' => $logInAsUserURL]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function isDisplayNameUnique(Request $request)
    {
        $validator = validator($request->all(), [
            'display_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()], 422);
        }

        $user =
            User::where('display_name', $request->display_name)
                ->where('id', '!=', user()->id)
                ->first();

        if ($user) {
            return response()->json(['unique' => false]);
        }

        return response()->json(['unique' => true]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function isEmailUnique(Request $request)
    {
        $validator = validator($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()], 422);
        }
        $user =
            User::where('email', $request->email)
                ->first();

        if ($user) {
            return response()->json(['unique' => false, 'is_musora_account_set_up' => $user->isAccountSetup()]);
        }

        return response()->json(['unique' => true, 'is_musora_account_set_up' => false]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function report($id)
    {
        $user = User::find($id);
        if (!$user) {
            throw new NotFoundHttpException();
        }

        $currentUser = user();
        $brand = brand();

        ReportedUser::firstOrNew([
            'user_id' => $id,
            'reporter_id' => $currentUser['id'],
            "created_on" => Carbon::now()
                ->toDateTimeString(),
        ])
            ->save();

        $input['subject'] = 'User reported by ' . $currentUser['display_name'] . " (" . $currentUser['email'] . ")";
        $input['sender-address'] = config('mailora.report-sender-address');
        $input['sender-name'] = config('mailora.report-sender-name');
        $input['lines'] = ['The following user has been reported:'];
        $input['lines'][] = $user['display_name'];
        $input['lines'][] = $user['email'];
        $input['lines'][] = url()->route('platform.profile.dashboard', [
            'brand' => brand(),
            'userId' => $user['id'],
        ]);

        $input['alert'] = 'User reported by ' . $currentUser['display_name'] . " (" . $currentUser['email'] . ")";

        $input['logo'] = config('mailora.' . $brand . '.logo-link');
        $input['type'] = 'layouts/inline/alert';
        $input['recipient'] = config('mailora.' . $brand . '.report-user-recipient');

        try {
            $this->mailService->sendSecure($input);
        } catch (\Exception $exception) {
            return response()->json([
                "success" => false,
                "message" => $exception->getMessage(),
            ], 500);
        }

        return response()->json([
            "success" => true,
            "message" => "The user profile was reported",
        ], 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function blockUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            throw new NotFoundHttpException();
        }

        $currentUser = user();
        $blocked = BlockedUser::firstOrNew([
            'user_id' => $id,
            'blocker_id' => $currentUser['id'],
            "created_on" => Carbon::now()
                ->toDateTimeString(),
        ])
            ->save();

        return response()->json([
            "success" => $blocked,
            "message" => $user['display_name'] . " was blocked",
        ], 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function unblockUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            throw new NotFoundHttpException();
        }

        $currentUser = user();
        $unblock =
            BlockedUser::where('user_id', '=', $id)
                ->where('blocker_id', '=', $currentUser['id'])
                ->delete();

        return response()->json([
            "success" => $unblock > 0,
            "message" => $user['display_name'] . " was unblocked",
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getBlockedUsers(Request $request)
    {
        $currentUser = user();
        $limit = $request->get('limit', 2);
        $skip = ($request->get('page', 1) - 1) * $limit;
        $blocked =
            BlockedUser::where('blocker_id', '=', $currentUser['id'])
                ->skip($skip)
                ->take($limit)
                ->orderBy('created_on', 'desc')
                ->get();
        $blockedUsersIds =
            $blocked->pluck('user_id')
                ->toArray();

        $users =
            User::query()
                ->whereIn('id', $blockedUsersIds)
                ->get();

        return response()->json([
            "data" => $users,
            "meta" => [
                "totalResulsts" => BlockedUser::where('blocker_id', '=', $currentUser['id'])
                    ->count(),
                "page" => $request->get('page', 1),
                "limit" => $request->get('limit', 2),
            ],
        ], 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function isReportedUser($id)
    {
        $currentUser = user();
        $reported =
            ReportedUser::where('user_id', '=', $id)
                ->where('reporter_id', '=', $currentUser['id'])
                ->first();

        return response()->json([
            "reported" => $reported ? true : false,
        ], 200);
    }
}
