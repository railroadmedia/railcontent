<?php

namespace Railroad\Railcontent\Listeners;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;


class RailcontentEventSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::postPersist
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $name = strtolower(explode('\\', get_class($entity))[3]);

        if (array_key_exists($name, config('resora.decorators'))) {

            foreach (config('resora.decorators')[$name] as $decoratorClassName) {
                $decorator = app()->make($decoratorClassName);

                $decorator->decorate($entity);
            }
        }
    }

}