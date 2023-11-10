<?php

namespace App\Modules\Ecommerce\Services;

use Illuminate\Support\Facades\Session as LaravelSession;
use Shopify\Auth\Session;
use Shopify\Auth\SessionStorage;

class ShopifyStoreFrontAPISessionService implements SessionStorage
{
    const SESSION_KEY = 'shopify_storefront_session_';

    public function storeSession(Session $session): bool
    {
        LaravelSession::put(self::SESSION_KEY . '_' . $session->getId(), $session);

        return true;
    }

    public function loadSession(string $sessionId)
    {
        return LaravelSession::get(self::SESSION_KEY . '_' . $sessionId);
    }

    public function deleteSession(string $sessionId): bool
    {
        LaravelSession::remove(self::SESSION_KEY . '_' . $sessionId);

        return true;
    }
}
