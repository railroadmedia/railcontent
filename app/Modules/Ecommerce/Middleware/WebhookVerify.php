<?php

namespace App\Modules\Ecommerce\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Log;

class WebhookVerify
{
    public function handle($request, Closure $next)
    {
        $secret = env('SHOPIFY_WEBHOOK_SECRET');
        if (!$secret) {
            Log::warning('SHOPIFY_WEBHOOK_SECRET not set in .env file.  Endpoints not protected.');
            return $next($request);
        }
        $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
        $data = file_get_contents('php://input');
        $calculated_hmac = base64_encode(hash_hmac('sha256', $data, $secret, true));

        if (hash_equals($calculated_hmac, $hmac_header)) {
            return $next($request);
        } else {
            throw new AuthenticationException("Invalid shopify webhook request.");
        }
    }
}
