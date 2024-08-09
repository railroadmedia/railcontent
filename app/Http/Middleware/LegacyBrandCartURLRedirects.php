<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    ): Response {
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
