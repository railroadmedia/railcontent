<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\User as EcommerceUser;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Services\UserProductService;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;

class LegacyBrandCartURLRedirects
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(
        Request $request,
        Closure $next
    ) {
        $parse = parse_url(\Request::getRequestUri());
        $parse['path'] = $parse['path'] ?? '';
        $parse['query'] = $parse['query'] ?? '';

        if (Str::startsWith($parse['path'], '/ecommerce/add-to-cart')) {
            parse_str($parse['query'], $queryStringArray);
            $parse['host'] = $request->host();

            if (Str::endsWith($parse['host'], 'drumeo.com')) {
                $queryStringArray['redirect'] = '/order/drumeo';
                
                return redirect()->away(
                    get_musora_brand_base_url() . $parse['path'] . '?' . (http_build_query($queryStringArray))
                );
            } elseif (Str::endsWith($parse['host'], 'pianote.com')) {
                $queryStringArray['redirect'] = '/order/pianote';

                return redirect()->away(
                    get_musora_brand_base_url() . $parse['path'] . '?' . (http_build_query($queryStringArray))
                );
            } elseif (Str::endsWith($parse['host'], 'guitareo.com')) {
                $queryStringArray['redirect'] = '/order/guitareo';

                return redirect()->away(
                    get_musora_brand_base_url() . $parse['path'] . '?' . (http_build_query($queryStringArray))
                );
            } elseif (Str::endsWith($parse['host'], 'singeo.com')) {
                $queryStringArray['redirect'] = '/order/singeo';

                return redirect()->away(
                    get_musora_brand_base_url() . $parse['path'] . '?' . (http_build_query($queryStringArray))
                );
            }
        }

        return $next($request);
    }
}
