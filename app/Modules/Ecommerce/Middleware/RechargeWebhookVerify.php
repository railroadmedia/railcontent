<?php

namespace App\Modules\Ecommerce\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Log;

class RechargeWebhookVerify
{
    /**
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        $secret = config('shopify.recharge.webhook_secret');
        if (!$secret) {
            Log::warning('RECHARGE_WEBHOOK_SECRET not set in .env file. Endpoints not protected.');
            return $next($request);
        }
        $hmac_header = $_SERVER['HTTP_X_RECHARGE_HMAC_SHA256'];
        $data = file_get_contents('php://input');
        $calculated_hmac = hash('sha256', $secret . $data);

        if (hash_equals($calculated_hmac, $hmac_header)) {
            return $next($request);
        } else {
            Log::warning('Invalid recharge webhook request.');
            throw new AuthenticationException("Invalid recharge webhook request.");
        }
    }
}
