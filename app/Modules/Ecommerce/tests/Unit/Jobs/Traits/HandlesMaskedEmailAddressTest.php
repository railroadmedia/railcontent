<?php

namespace App\Modules\Ecommerce\tests\Unit\Jobs\Traits;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use ReflectionException;
use Tests\TestCase;
use Tests\traits\CreatesReflectionMethod;

class HandlesMaskedEmailAddressTest extends TestCase
{
    use CreatesReflectionMethod;

    protected HandlesMaskedEmailAddressTraitJob $traitJob;

    /**
     * @throws ReflectionException
     */
    public function test_get_is_using_mask_respects_environment()
    {
        $method = $this->getReflectionMethod($this->traitJob, 'getIsUsingMask');

        // environment is non-prod by default
        $this->assertTrue($method->invoke($this->traitJob));

        // mock being in prod
        $this->setProductionApp();
        $this->assertFalse($method->invoke($this->traitJob));
    }

    /**
     * Set the environment to production
     */
    private function setProductionApp(): void
    {
        $this->app->detectEnvironment(function () {
            return 'production';
        });
    }

    /**
     * @throws ReflectionException
     */
    public function test_get_email_from_shopify_returns_unchanged_in_production()
    {
        $this->setProductionApp();
        $method = $this->getReflectionMethod($this->traitJob, 'getEmailFromShopify');

        // test with normal email
        $email = 'foo@bar.com';
        $this->assertEquals($email, $method->invoke($this->traitJob, $email));

        // and with the suffix added
        $email = $email.$this->traitJob->fakeSuffix;
        $this->assertEquals($email, $method->invoke($this->traitJob, $email));
    }

    /**
     * @throws ReflectionException
     */
    public function test_get_email_from_shopify_removes_suffix_in_non_production()
    {
        $method = $this->getReflectionMethod($this->traitJob, 'getEmailFromShopify');

        // test with normal email
        $email = 'foo@bar.com';
        $this->assertEquals($email, $method->invoke($this->traitJob, $email));

        // and with the suffix added
        $this->assertEquals($email, $method->invoke($this->traitJob, $email.$this->traitJob->fakeSuffix));
    }

    /**
     * @throws ReflectionException
     */
    public function test_get_email_from_shopify_does_not_removes_suffix_value_before_end()
    {
        // test with normal email
        $email = "foo{$this->traitJob->fakeSuffix}@bar.com";
        $method = $this->getReflectionMethod($this->traitJob, 'getEmailFromShopify');

        $this->assertEquals($email, $method->invoke($this->traitJob, $email.$this->traitJob->fakeSuffix));
    }

    /**
     * @throws ReflectionException
     */
    public function test_get_email_for_shopify_works()
    {
        $method = $this->getReflectionMethod($this->traitJob, 'getEmailFromShopify');
        $email = 'foo@bar.com';
        $this->assertEquals($email, $method->invoke($this->traitJob, $email.$this->traitJob->fakeSuffix));

        $this->setProductionApp();
        $this->assertEquals($email, $method->invoke($this->traitJob, $email));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->traitJob = new HandlesMaskedEmailAddressTraitJob();
    }
}

class HandlesMaskedEmailAddressTraitJob
{
    use HandlesMaskedEmailAddress;
}
