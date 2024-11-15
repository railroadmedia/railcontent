<?php

namespace App\Modules\Content\Resources\Algolia\Model\Search\Hit;

use Algolia\AlgoliaSearch\Model\Search\Hit;
use ReflectionClass;

/**
 * Abstracting to extend the Algolia Hit class, which represents something found by the search.
 * We use this abstraction so that we can define the attributes that are a part of that specific index's entries,
 * and use those as properties on the Hit.
 */
abstract class MusoraHitClass extends Hit
{
    public function __construct(?array $data = null)
    {
        parent::__construct($data);

        // populate our properties
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            if ($property->getDeclaringClass()->getName() === get_called_class()) {
                $propertyName = $property->getName();
                if (isset($data[$propertyName])) {
                    $this->setProperty($propertyName, $data[$propertyName]);
                }
            }
        }
    }

    abstract protected function setProperty(string $propertyName, $value): void;
}
