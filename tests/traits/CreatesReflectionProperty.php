<?php

namespace Tests\traits;

use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

trait CreatesReflectionProperty
{
    /**
     * Get the value for the non-public property of the trait-using job, so we can call it
     *
     * @param  object  $object
     * @param  string  $property
     * @return ReflectionMethod
     * @throws ReflectionException
     */
    protected function getReflectionProperty(object $object, string $property): mixed
    {
        $reflectedClass = new ReflectionClass($object);
        $reflection = $reflectedClass->getProperty($property);
        $reflection->setAccessible(true);
        return $reflection->getValue($object);
    }
}
