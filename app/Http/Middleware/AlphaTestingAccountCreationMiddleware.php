<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\User as EcommerceUser;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Services\UserProductService;

class AlphaTestingAccountCreationMiddleware
{
    private UserProductService $userProductService;
    private ProductRepository $productRepository;

    public function __construct(
        UserProductService $userProductService,
        ProductRepository $productRepository
    ) {
        $this->userProductService = $userProductService;
        $this->productRepository = $productRepository;
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
        if ($request->routeIs('user_management_system.login.cookie')) {
            $user = new User;

            $user->email = $request->get('email');
            $user->setPassword($request->get('password'));
            $user->display_name = 'test_user_' . rand();
            $user->save();

            $newUser = User::where('email', $user->email)->first();;

            event(new UserCreated($newUser));

            if (strpos($user->email, 'pack') !== 0) {
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
            } elseif (strpos($user->email, 'expired') !== 0) {
                // make expired member (no packs)
                $this->userProductService->assignUserProduct(
                    new EcommerceUser($newUser->id, $newUser->email),
                    $this->productRepository->find(125),
                    Carbon::now()->subMonth()
                );
            } elseif (strpos($user->email, 'member') !== 0) {
                // make member
                $this->userProductService->assignUserProduct(
                    new EcommerceUser($newUser->id, $newUser->email),
                    $this->productRepository->find(125),
                    Carbon::now()->addMonths(6)
                );
            }

            auth()->login($user);
        }

        return $next($request);
    }
}
