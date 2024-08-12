<?php

namespace Tests\traits;

use ReflectionException;
use ReflectionMethod;

trait CreatesReflectionMethod
{
    /**
     * Get a reflection method for the non-public method of the trait-using job, so we can call it
     *
     * @throws ReflectionException
     */
    protected function getReflectionMethod(object $object, string $methodName): ReflectionMethod
    {
        $method = new ReflectionMethod($object, $methodName);
        $method->setAccessible(true);
        return $method;
    }
}
