<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Signifly\Shopify\Shopify;

trait HandlesShopifyRateLimit
{
    use LogsShopify;

    protected Shopify $shopify;

    protected int $rateLimitThreshold;
    protected int $rateLimitSleepTime;

    /**
     * WARNING: Do NOT call this before the first `$this->>shopify->___` call, because there will not yet be
     * an existing last response.
     *
     * Check the API call rate limit based on the last response, to see if we're approaching our limit, and
     * to sleep if so, to recover our calls.
     * This needs to be called before any `$this->>shopify->___` calls that you want to protect.
     *
     * @param  bool  $forceUsage to handle the rate limit, even if running a simulation
     * @return void
     */
    protected function handleRateLimit(bool $forceUsage = false): void
    {
        if ($this->getIsSimulation() && !$forceUsage) {
            return;
        }

        // set the headers keys to all caps, to avoid any issues with casing
        $headers = $this->shopify->getLastResponse()?->headers() ?? null;
        if (is_null($headers)) {
            return;
        }
        $headers = array_change_key_case($headers, CASE_UPPER);

        $limit = $headers["X-SHOPIFY-SHOP-API-CALL-LIMIT"][0] ?? null;
        if (is_null($limit)) {
            return;
        }

        // set up the configurable values once, sort of hacking around a constructor
        if (!isset($this->rateLimitThreshold)) {
            $this->rateLimitThreshold = $this->getRateLimitThreshold();
        }
        if (!isset($this->rateLimitSleepTime)) {
            $this->rateLimitSleepTime = $this->getRateLimitSleepTime();
        }

        $current = intval(Str::before($limit, "/"));
        $max = intval(Str::after($limit, "/"));

        if ($max - $current <= $this->rateLimitThreshold) {
            Log::info(sprintf("%s: Shopify API Call Limit: %s", $this->getClassName(), $limit));
            $this->logWarning(
                sprintf(
                    "%s: About to hit API rate limit. Sleeping for %s %s...",
                    $this->getClassName(),
                    $this->rateLimitSleepTime,
                    Str::plural("second", $this->rateLimitSleepTime)
                )
            );
            sleep($this->rateLimitSleepTime);
        }
    }

    /**
     * Are we running in simulation mode?
     *
     * @return bool
     */
    abstract protected function getIsSimulation(): bool;

    /**
     * Get the threshold of what we'll allow the rate limit to get within
     *
     * @return int
     */
    protected function getRateLimitThreshold(): int
    {
        return config('shopify.rate_limit.threshold');
    }

    /**
     * Get the number of seconds that we'll sleep for when we hit the rate limit threshold
     *
     * @return int
     */
    protected function getRateLimitSleepTime(): int
    {
        return config('shopify.rate_limit.sleep_time');
    }
}
