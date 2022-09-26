<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\User as EcommerceUser;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Services\UserProductService;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;

class AlphaTestingAccountCreationMiddleware
{
    private UserProductService $userProductService;
    private ProductRepository $productRepository;
    private UserMembershipFieldsService $userMembershipFieldsService;

    public function __construct(
        UserProductService $userProductService,
        ProductRepository $productRepository,
        UserMembershipFieldsService $userMembershipFieldsService
    ) {
        $this->userProductService = $userProductService;
        $this->productRepository = $productRepository;
        $this->userMembershipFieldsService = $userMembershipFieldsService;
    }

    /**
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(
        Request $request,
        Closure $next
    ) {
        if (app()->runningUnitTests()) {
            return $next($request);
        }

        if ($request->routeIs('user_management_system.login.cookie') &&
            !User::query()->where('email', $request->get('email'))->exists()) {
            $user = new User;

            $user->email = $request->get('email');
            $user->setPassword($request->get('password'));
            $user->display_name = 'test_user_' . rand();
            $user->save();

            $newUser = User::where('email', $user->email)->first();;

            event(new UserCreated($newUser));

            if (strpos($user->email, 'pack') !== false) {
                // make pack only user
                $this->userProductService->assignUserProduct(
                    new EcommerceUser($newUser->id, $newUser->email),
                    $this->productRepository->find(77),
                    null
                );
                $this->userProductService->assignUserProduct(
                    new EcommerceUser($newUser->id, $newUser->email),
                    $this->productRepository->find(404),
                    null
                );
            } elseif (strpos($user->email, 'expired') !== false) {
                // make expired member (no packs)
                $this->userProductService->assignUserProduct(
                    new EcommerceUser($newUser->id, $newUser->email),
                    $this->productRepository->find(125),
                    Carbon::now()->subMonth()
                );
//            } elseif (strpos($user->email, 'member') !== false) {
            } else { // for now always make them a member by default
                // make member
                $this->userProductService->assignUserProduct(
                    new EcommerceUser($newUser->id, $newUser->email),
                    $this->productRepository->find(125),
                    Carbon::now()->addMonths(6)
                );
            }

            $this->userMembershipFieldsService->sync($user->id);

            auth()->login($user);
        }

        // generate data for all logins even existing accounts
        if ($request->routeIs('user_management_system.login.cookie') &&
            User::query()->where('email', $request->get('email'))->exists()) {
            Artisan::call('SeedUserContentData', ['userEmail' => $request->get('email')]);
        }

        return $next($request);
    }
}
