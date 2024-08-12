<?php

namespace App\Modules\MusoraCenter\Middleware;

use Closure;
use Illuminate\Http\Request;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Repositories\ContentRepository;

class MusoraCenterAdmin
{
    /**
     * @var PermissionService
     */
    private $permissionService;
    /**
     * @var EcommerceEntityManager
     */
    private $ecommerceEntityManager;

    /**
     * Authentication constructor.
     */
    public function __construct(PermissionService $permissionService, EcommerceEntityManager $ecommerceEntityManager)
    {
        $this->permissionService = $permissionService;
        $this->ecommerceEntityManager = $ecommerceEntityManager;
    }

    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if (!empty($user) &&
            ($this->permissionService->is(auth()->id(), 'administrator') ||
                $this->permissionService->is(auth()->id(), 'super_administrator') ||
                $this->permissionService->is(auth()->id(), 'shipping_fulfillment') ||
                $this->permissionService->is(auth()->id(), 'payment_recovery') ||
                $this->permissionService->is(auth()->id(), 'view_daily_stats'))) {

            ContentRepository::$bypassPermissions = true;
            ContentRepository::$pullFutureContent = true;
            ContentRepository::$availableContentStatues = false;

            $this->ecommerceEntityManager->getFilters()
                ->disable('soft-deleteable');

            return $next($request);
        }

        session()->put('login-success-redirect-url', $request->url());
        session()->put('login-page-url', url()->route('login', ['redirect_to' => $request->url()]));

        return redirect()->to('/' . brand());
    }
}
