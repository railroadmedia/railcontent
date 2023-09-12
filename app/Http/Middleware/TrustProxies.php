<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;

    public function handle(Request $request, \Closure $next)
    {
        // check for any trust proxies that have been configured
        $proxies = config('trust-proxies.proxies', []);
        if (!empty($proxies)) {
            $allProxies = collect();
            $allProxies = $allProxies->push($this->proxies, $proxies)
                ->flatten()
                ->filter(); // no args = filter out empty values

            $this->proxies = $allProxies;
        }

        return parent::handle($request, $next);
    }
}
