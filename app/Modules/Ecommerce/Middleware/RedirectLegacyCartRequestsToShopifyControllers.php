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
        $requestURL = $request->getUri();
        $parse = parse_url($requestURL);
        $parse['path'] = $parse['path'] ?? '';
        $parse['query'] = $parse['query'] ?? '';
        $brandDomains = ['drumeo.com', 'pianote.com', 'guitareo.com', 'singeo.com'];

        // always redirect brand domains to musora domain so sessions are always on musora.com
        if (in_array($this->getHostDomainFromFullDomain($parse['host']), $brandDomains) &&
            (in_array(trim($request->path(), '/'), ['order/drumeo', 'order/pianote', 'order/guitareo', 'order/singeo', 'order'])) &&
            $request->method() == 'GET' &&
            Str::endsWith($parse['host'], $brandDomains)) {

            $musoraURL = Str::replace($brandDomains, 'musora.com', $requestURL);

            // pass shopify cart id as well since we cannot share these session cookies across domains
            $shopifyCartSessionId = session(ShopifyCartAPIController::SHOPIFY_CART_ID_SESSION_KEY);

            if (!empty($shopifyCartSessionId)) {
                $musoraURL = $musoraURL . '?shopify-cart-id=' . $shopifyCartSessionId;
            }

            return redirect()->away($musoraURL);
        }

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

        if ((Str::startsWith($request->path(), 'ecommerce/json/update-product-quantity') && $request->method(
            ) == 'PATCH')) {
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

        if ($request->path() == 'ecommerce/json/order-form/submit' && $request->method() == 'PUT') {
            // in case any users have an open session since before the Shopify switch, just 404 them when they try to order
            return abort(404);
        }

        return $next($request);
    }

    /**
     * Removes subdomain from url if it exists: converts 'www.musora.com' to 'musora.com'
     * @return string
     */
    private function getHostDomainFromFullDomain($hostWithSubdomain)
    {
        $array = explode(".", $hostWithSubdomain);

        return (array_key_exists(count($array) - 2, $array) ? $array[count($array) - 2] : "") . "." . $array[count(
                $array
            ) - 1];
    }
}
