<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ValidateRedirectUrl
{
    public function handle(Request $request, Closure $next)
    {
        // handle either format of the "redirect to" request key
        if ($request->filled('redirect_to')) {
            $redirect = $request->get('redirect_to');
            $key = 'redirect_to';
        } elseif ($request->filled('redirectTo')) {
            $redirect = $request->get('redirectTo');
            $key = 'redirectTo';
        } else {
            $redirect = null;
            $key = null;
        }

        if ($redirect) {
            if (!$this->isValidateRedirect($redirect)) {
                // remove the redirect URL in the request if invalid (from both the request and query params)
                $otherInput = $request->except($key);
                $request->replace($otherInput);
                $request->request->replace($otherInput);
                $request->query->remove($key);
            }
        }

        return $next($request);
    }

    /**
     * Get if this url is a valid redirect within our system
     */
    protected function isValidateRedirect(string $url): bool
    {
        $parsedUrl = parse_url($url);
        $host = $parsedUrl['host'] ?? null;

        if ($host) {
            return $this->isTrustedHost($host);
        }

        // if there's no host, it's a local path and is safe
        return true;
    }

    /**
     * Get if this host is one of the trusted hosts from the TrustHosts middleware.
     * This replicates the logic from Request's getHost() function.
     */
    protected function isTrustedHost(string $host): bool
    {
        $trustHosts = App::make(TrustHosts::class);
        $trustedHosts = $trustHosts->hosts();

        // the trusted hosts can be a literal host name or a regex pattern,
        // so first check if the host name is in the array
        if (in_array($host, $trustedHosts)) {
            return true;
        }

        // then check the regex pattern if not
        foreach ($trustedHosts as $pattern) {
            if (preg_match("/^{$pattern}$/i", $host)) {
                return true;
            }
        }

        return false;
    }
}
