<?php

namespace App\Modules\Ecommerce\tests\Unit\Jobs\Traits;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use ReflectionException;
use Tests\BaseTestCase;

class LogsShopifyTest extends BaseTestCase
{
    use CreatesReflectionMethod;

    protected array $logTypes = ['info', 'debug', 'warning', 'error'];

    protected LogsShopifyTraitJob $traitJob;

    protected function setUp(): void
    {
        parent::setUp();
        $this->traitJob = new LogsShopifyTraitJob();
    }

    /**
     * @throws ReflectionException
     */
    public function test_class_with_trait_log_functions_work()
    {
        // perform each test within this one function to save time with the setup for each test
        $this->log_test('info');
        $this->log_test('debug');
        $this->log_test('warning');
        $this->log_test('error');
    }

    /**
     * @throws ReflectionException
     */
    protected function log_test(string $type): void
    {
        // safety check
        $this->assertContains($type, $this->logTypes);

        $methodName = 'log' . Str::ucfirst($type);
        $testMessage = "$type message";
        $method = $this->getReflectionMethod($this->traitJob, $methodName);

        Log::shouldReceive($type)
            ->once()
            ->withArgs(function ($message) use ($testMessage) {
                return str_contains($message, $testMessage);
            });

        $method->invoke($this->traitJob, $testMessage);
    }

    /**
     * @throws ReflectionException
     */
    public function test_class_with_trait_returns_class_name()
    {
        $method = $this->getReflectionMethod($this->traitJob, 'getClassName');
        $this->assertEquals('LogsShopifyTraitJob', $method->invoke($this->traitJob));
    }
}

class LogsShopifyTraitJob
{
    use LogsShopify;

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return 'LogsShopifyTraitJob';
    }
}
