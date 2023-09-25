<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Services\AccessCodeService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Railroad\Ecommerce\Contracts\UserProviderInterface;
use Railroad\Ecommerce\Requests\AccessCodeClaimRequest;
use Throwable;

class AccessCodeController extends Controller
{
    /**
     * @var AccessCodeService
     */
    private AccessCodeService $accessCodeService;

    /**
     * @var UserProviderInterface
     */
    private UserProviderInterface $userProvider;

    /**
     * @var UserAccessPermissionsService
     */
    private UserAccessPermissionsService $userAccessPermissionsService;

    /**
     * AccessCodeController constructor.
     *
     * @param AccessCodeService $accessCodeService
     * @param UserProviderInterface $userProvider
     * @param UserAccessPermissionsService $userAccessPermissionsService
     */
    public function __construct(
        AccessCodeService $accessCodeService,
        UserProviderInterface $userProvider,
        UserAccessPermissionsService $userAccessPermissionsService,
    ) {
        $this->accessCodeService = $accessCodeService;
        $this->userProvider = $userProvider;
        $this->userAccessPermissionsService = $userAccessPermissionsService;
    }

    /**
     * Claim an access code
     *
     * @param AccessCodeClaimRequest $request
     *
     * @return RedirectResponse
     *
     * @throws Throwable
     */
    public function claim(AccessCodeClaimRequest $request)
    {
        if ($request->has('user_email')) {
            if ($this->userProvider->checkCredentials(
                $request->get('user_email'),
                $request->get('user_password')
            )) {
                $user = $this->userProvider->getUserByEmail($request->get('user_email'));
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['Invalid credentials.']);
            }
        } else {
            $user = $this->userProvider->createUser($request->get('email'), $request->get('password'));
        }

        $rawAccessCode = $request->get('access_code');

        $productIds = $this->accessCodeService->getAccessCodeProducts($rawAccessCode);

        /*
         * SRR-37: Update user permissions
         */
        $this->userAccessPermissionsService->addUserAccessPermissionsForProducts(
            $user->getId(),
            $productIds,
            Carbon::now(),
            UserAccessPermissionsSourceEnum::AccessCode,
        );

        $accessCode = $this->accessCodeService->claim($rawAccessCode, $user, $request->get('context'));

        auth()->loginUsingId($user->getId(), true);

        $message = [
            'access-code-claimed-success' => true,
            'access-code-claimed-message' => 'Your access code has been claimed successfully!',
        ];

        $redirectRoute =
            (in_array($accessCode->getBrand(), config('ecommerce.available_brands')) &&
                $accessCode->getBrand() != 'musora') ? $accessCode->getBrand() : "drumeo";

        return $request->has('redirect') ?
            redirect()
                ->away($request->get('redirect'))
                ->with($message) :
            redirect()
                ->to('/' . $redirectRoute)
                ->with($message);
    }
}
