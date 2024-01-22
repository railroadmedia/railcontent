<?php

namespace App\Modules\Ecommerce\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Log;

class ShopifyWebhookVerify
{
    public function handle($request, Closure $next)
    {
        $timeStart = microtime(true);
        $secret = config('shopify.webhooks.secret');
        if (!$secret) {
            Log::warning('SHOPIFY_WEBHOOK_SECRET not set in .env file.  Endpoints not protected.');
            return $next($request);
        }
        $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
        $data = file_get_contents('php://input');
        $calculated_hmac = base64_encode(hash_hmac('sha256', $data, $secret, true));

        if (hash_equals($calculated_hmac, $hmac_header)) {
            $result = $next($request);
            $sec = intval(microtime(true) - $timeStart);
            if ($sec >= 5) {
                Log::error("Shopify webhook request took $sec seconds.");
            }
            return $result;
        } else {
            Log::warning('Invalid shopify webhook request.');
            throw new AuthenticationException("Invalid shopify webhook request.");
        }
    }
}
