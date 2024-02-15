<?php

namespace App\Modules\Ecommerce\tests\Unit\Jobs\Traits;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use ReflectionException;
use Signifly\Shopify\Shopify;
use Tests\BaseTestCase;

class HandlesShopifyRateLimitTest extends BaseTestCase
{
    use CreatesReflectionMethod;

    protected HandlesShopifyRateLimitTraitJob $traitJob;

    /**
     * @throws ReflectionException
     */
    public function test_get_rate_limit_sleep_time_gets_value_from_config()
    {
        $method = $this->getReflectionMethod($this->traitJob, 'getRateLimitSleepTime');
        $defaultValue = config('shopify.rate_limit.sleep_time');
        $this->assertEquals($defaultValue, $method->invoke($this->traitJob));

        $newValue = $defaultValue + 100;
        Config::set('shopify.rate_limit.sleep_time', $newValue);
        $this->assertEquals($newValue, $method->invoke($this->traitJob));
    }

    /**
     * @throws ReflectionException
     */
    public function test_get_rate_limit_threshold_gets_value_from_config()
    {
        $method = $this->getReflectionMethod($this->traitJob, 'getRateLimitThreshold');
        $defaultValue = config('shopify.rate_limit.threshold');
        $this->assertEquals($defaultValue, $method->invoke($this->traitJob));

        $newValue = $defaultValue + 100;
        Config::set('shopify.rate_limit.threshold', $newValue);
        $this->assertEquals($newValue, $method->invoke($this->traitJob));
    }

    /**
     * @throws ReflectionException
     */
    public function test_handle_rate_limit_works_when_rate_limit_hits_threshold_and_is_not_simulation()
    {
        $this->traitJob->setIsSimulation(false);
        // TODO use the sleep facade when we upgrade to Laravel 10
        // we don't want to wait long, so set the sleep time to 1s
        Config::set('shopify.rate_limit.sleep_time', 1);

        $this->setUpShopifyResponseHeader(5, 5);

        $method = $this->getReflectionMethod($this->traitJob, 'handleRateLimit');
        $startTime = time();

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) {
                return str_contains(
                    $message,
                    "{$this->traitJob->getProtectedClassName()}: Shopify API Call Limit: 5/5"
                );
            });

        Log::shouldReceive("warning")
            ->once()
            ->withArgs(function ($message) {
                return str_contains(
                    $message,
                    "{$this->traitJob->getProtectedClassName()}: About to hit API rate limit. Sleeping for 1 second"
                );
            });

        $method->invoke($this->traitJob);
        $endTime = time();

        // make sure we slept
        $this->assertTrue($endTime - $startTime >= 1);
    }

    /**
     * Use Faked HTTP calls to replicate receiving a response from Shopify with the given rate limit values
     * in its header
     *
     * @param  int  $count
     * @param  int  $limit
     * @return void
     */
    private function setUpShopifyResponseHeader(int $count, int $limit): void
    {
        $shopify = $this->traitJob->getShopify();
        $callLimit = "$count/$limit";
        // make a fake http response, where we set the requisite header to be at the limit
        Http::fake([
            '*' => Http::response([], 200, ["X-Shopify-Shop-Api-Call-Limit" => $callLimit]),
        ]);
        // call $shopify->get() to make it load the fake response into its lastResponse variable
        $shopify->get("*");

        // sanity check
        $this->assertEquals(
            $callLimit,
            $shopify->getLastResponse()?->headers()["X-Shopify-Shop-Api-Call-Limit"][0] ?? null
        );
    }

    /**
     * @throws ReflectionException
     */
    public function test_handle_rate_limit_works_when_rate_limit_hits_threshold_and_is_simulation_with_forced_usage()
    {
        // TODO use the sleep facade when we upgrade to Laravel 10
        Config::set('shopify.rate_limit.sleep_time', 1);

        $this->setUpShopifyResponseHeader(5, 5);

        $method = $this->getReflectionMethod($this->traitJob, 'handleRateLimit');
        $startTime = time();

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) {
                return str_contains(
                    $message,
                    "{$this->traitJob->getProtectedClassName()}: Shopify API Call Limit: 5/5"
                );
            });

        Log::shouldReceive("warning")
            ->once()
            ->withArgs(function ($message) {
                return str_contains(
                    $message,
                    "{$this->traitJob->getProtectedClassName()}: About to hit API rate limit. Sleeping for 1 second"
                );
            });

        $method->invoke($this->traitJob, true);
        $endTime = time();

        // make sure we slept
        $this->assertTrue($endTime - $startTime >= 1);
    }

    /**
     * @throws ReflectionException
     */
    public function test_handle_rate_limit_does_nothing_when_is_simulation()
    {
        $method = $this->getReflectionMethod($this->traitJob, 'handleRateLimit');

        $startTime = time();
        Log::shouldReceive("info")
            ->never();
        Log::shouldReceive("warning")
            ->never();
        $method->invoke($this->traitJob);
        $endTime = time();
        $this->assertTrue($endTime - $startTime == 0);
    }

    /**
     * @throws ReflectionException
     */
    public function test_handle_rate_limit_does_nothing_when_no_shopify_api_call_limit_headers()
    {
        // set the sleep time to a high threshold, so we can make sure we're under it
        // DEV NOTE: we can't rely on 0, because the tests themselves may take longer than 0s
        Config::set('shopify.rate_limit.sleep_time', 5);
        $method = $this->getReflectionMethod($this->traitJob, 'handleRateLimit');

        $shopify = $this->traitJob->getShopify();
        Http::fake([
            '*' => Http::response([], 200),
        ]);
        $shopify->get("*");

        $startTime = time();
        Log::shouldReceive("info")
            ->never();
        Log::shouldReceive("warning")
            ->never();
        $method->invoke($this->traitJob, true);
        $endTime = time();
        $this->assertTrue($endTime - $startTime < 5);
    }

    /**
     * @throws ReflectionException
     */
    public function test_handle_rate_limit_does_nothing_when_under_threshold()
    {
        Config::set('shopify.rate_limit.threshold', 1);
        // TODO use the sleep facade when we upgrade to Laravel 10
        Config::set('shopify.rate_limit.sleep_time', 1);

        $this->traitJob->setIsSimulation(false);
        $method = $this->getReflectionMethod($this->traitJob, 'handleRateLimit');

        $this->setUpShopifyResponseHeader(1, 5);

        $startTime = time();
        Log::shouldReceive("info")
            ->never();
        Log::shouldReceive("warning")
            ->never();
        $method->invoke($this->traitJob, true);
        $endTime = time();
        $this->assertTrue($endTime - $startTime == 0);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->traitJob = new HandlesShopifyRateLimitTraitJob();
    }

}

class HandlesShopifyRateLimitTraitJob
{
    use HandlesShopifyRateLimit;

    protected bool $isSimulation = true;

    public function __construct()
    {
        $this->shopify = app(Shopify::class);
    }

    /**
     * Unique function for this class, so we can access the Shopify client
     *
     * @return Shopify
     */
    public function getShopify(): Shopify
    {
        return $this->shopify;
    }

    /**
     * Unique function for this class, so we can access the class name without additional reflection calls
     */
    public function getProtectedClassName(): string
    {
        return $this->getClassName();
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return 'HandlesShopifyRateLimitTraitJob';
    }

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return $this->isSimulation;
    }

    /**
     * Unique function for this class, so we can test different scenarios with simulation on/off
     *
     * @param  bool  $isSimulation
     * @return void
     */
    public function setIsSimulation(bool $isSimulation): void
    {
        $this->isSimulation = $isSimulation;
    }
}
