<?php

namespace App\Modules\Ecommerce\tests\Unit\Jobs\Traits;

use ReflectionException;
use ReflectionMethod;

trait CreatesReflectionMethod
{

    /**
     * Get a reflection method for the non-public method of the trait-using job, so we can call it
     *
     * @param  Object  $traitJob
     * @param  string  $methodName
     * @return ReflectionMethod
     * @throws ReflectionException
     */
    protected function getReflectionMethod(object $traitJob, string $methodName): ReflectionMethod
    {
        $method = new ReflectionMethod($traitJob, $methodName);
        $method->setAccessible(true);
        return $method;
    }
}
