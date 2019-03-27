<?php

namespace Railroad\Railcontent\Hydrators;

use Doctrine\ORM\Internal\Hydration\ObjectHydrator;
use Railroad\Railcontent\Decorators\DecoratorInterface;

class RailcontentHydrator extends ObjectHydrator
{
    protected function hydrateAllData()
    {
        $objects = parent::hydrateAllData();

        foreach (config('railcontent.decorators') as $entityClass => $decoratorClasses) {
            foreach ($decoratorClasses as $decoratorClass) {

                // im not sure if its possible for the entity manager to return
                // multiple different entity classes in a single query, if so this will need some more work
                foreach ($objects as $object) {
                    if ($object instanceof $entityClass) {

                        /**
                         * @var $decoratorInstance DecoratorInterface
                         */
                        $decoratorInstance = app()->make($decoratorClass);

                        $objects = $decoratorInstance->decorate($objects);

                        // we only need to decorate once if this group of objects matches
                        break;
                    }
                }

            }
        }

        return $objects;
    }
}