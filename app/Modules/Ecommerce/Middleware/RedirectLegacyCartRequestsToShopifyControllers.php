<?php

namespace App\Modules\Ecommerce\Middleware;

use App\Modules\Ecommerce\Controllers\ShopifyCartAPIController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RedirectLegacyCartRequestsToShopifyControllers
{
    public function handle(Request $request, Closure $next)
    {
        if (($request->path() == 'ecommerce/json/add-to-cart' && $request->method() == 'PUT') ||
            ($request->path() == 'ecommerce/add-to-cart' && $request->method() == 'GET')) {
            $route = $request->route();

            $routeAction = array_merge($route->getAction(), [
                'uses' => ShopifyCartAPIController::class . '@createOrAddToCart',
                'controller' => ShopifyCartAPIController::class . '@createOrAddToCart',
            ]);

            $route->setAction($routeAction);
            $route->controller = false;
        }

        if ((Str::startsWith($request->path(), 'ecommerce/json/update-product-quantity') && $request->method() == 'PATCH')) {
            $route = $request->route();

            $routeAction = array_merge($route->getAction(), [
                'uses' => ShopifyCartAPIController::class . '@updateCartItemQuantity',
                'controller' => ShopifyCartAPIController::class . '@updateCartItemQuantity',
            ]);

            $route->setAction($routeAction);
            $route->controller = false;
        }

        if ((Str::startsWith($request->path(), 'ecommerce/json/remove-from-cart') && $request->method() == 'DELETE')) {
            $route = $request->route();

            $routeAction = array_merge($route->getAction(), [
                'uses' => ShopifyCartAPIController::class . '@deleteCartItem',
                'controller' => ShopifyCartAPIController::class . '@deleteCartItem',
            ]);

            $route->setAction($routeAction);
            $route->controller = false;
        }

        if ($request->path() == 'ecommerce/json/clear-cart' && $request->method() == 'DELETE') {
            $route = $request->route();

            $routeAction = array_merge($route->getAction(), [
                'uses' => ShopifyCartAPIController::class . '@deleteAllCartItems',
                'controller' => ShopifyCartAPIController::class . '@deleteAllCartItems',
            ]);

            $route->setAction($routeAction);
            $route->controller = false;
        }

        if ($request->path() == 'ecommerce/json/cart' && $request->method() == 'GET') {
            $route = $request->route();

            $routeAction = array_merge($route->getAction(), [
                'uses' => ShopifyCartAPIController::class . '@getCart',
                'controller' => ShopifyCartAPIController::class . '@getCart',
            ]);

            $route->setAction($routeAction);
            $route->controller = false;
        }

        return $next($request);
    }
}
