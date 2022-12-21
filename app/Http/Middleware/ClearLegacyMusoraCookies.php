<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Throwable;

class ClearLegacyMusoraCookies
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if there are duplicates of these, delete them all for the wildcard domain .musora.com or musora.com
        // laravel_session
        // XSRF-TOKEN
        // musora_web_platform_session
        // remember_user-management-system_*
        // remember_web_*
        // railtracker_visitor

        // unset cookies
        if (isset($_SERVER['HTTP_COOKIE'])) {
            try {
                $cookies = explode(';', $_SERVER['HTTP_COOKIE']);

                foreach ($cookies as $cookieIndex => $cookie) {
                    if (str_contains($cookie, 'cookieAccept=true')) {
                        unset($cookies[$cookieIndex]);
                    }
                }

                $cookiesWithDuplicateNames = [];
                $clearAllCookies = false;

                foreach ($cookies as $cookie) {
                    $parts = explode('=', $cookie);
                    $name = trim($parts[0]);
                    $shortCookieName = substr($name, 0, 12);

                    if (!isset($cookiesWithDuplicateNames[$shortCookieName])) {
                        $cookiesWithDuplicateNames[$shortCookieName] = 1;
                    } else {
                        $cookiesWithDuplicateNames[$shortCookieName] += 1;
                    }
                }

                foreach ($cookiesWithDuplicateNames as $shortCookieName => $count) {
                    if ($count > 1) {
                        $clearAllCookies = true;
                    }
                }

                if ($clearAllCookies) {
                    foreach ($cookies as $cookie) {
                        $parts = explode('=', $cookie);
                        $name = trim($parts[0]);
                        setcookie($name, '', time() - 1000);
                        setcookie($name, '', time() - 1000, '/');
                        setcookie($name, '', time() - 1000, '/', '.musora.com', true);
                        setcookie($name, '', time() - 1000, '/', '.musora.com', false);
                    }

                    $_COOKIE = [];
                    unset($_SERVER['HTTP_COOKIE']);
                }
            } catch (Throwable $throwable) {
                report($throwable);
            }
        }

        return $next($request);
    }
}
