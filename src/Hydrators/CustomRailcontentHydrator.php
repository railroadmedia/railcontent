<?php

namespace Railroad\Railcontent\Hydrators;

use Doctrine\Common\Inflector\Inflector;
use Doctrine\Common\Util\ClassUtils;
use Railroad\Railcontent\Decorators\DecoratorInterface;

class CustomRailcontentHydrator
{

    /**
     * @param $objects
     * @param $entityManager
     * @return array|mixed
     */
    public function hydrate(array $objects, $entityManager)
    {
        $allDecorators = [];

        foreach (config('railcontent.decorators') as $entityClass => $decoratorClasses) {
            foreach ($decoratorClasses as $decoratorClass) {

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

        foreach ($objects as $object) {
            if (is_object($object)) {
                $associations =
                    ($entityManager->getClassMetadata(get_class($object))
                        ->getAssociationMappings());

                foreach ($associations as $key => $value) {
                    if ($key == 'userProgress') {
                        break;
                    }

                    $getterName = Inflector::camelize('get' . ucwords($key));

                    if (method_exists($object, $getterName)) {

                        $result = call_user_func([$object, $getterName]);

                        if ($result) {
                            $result = (array)$result;
                            foreach ($result as $res) {
                                if (!is_object($res)) {
                                    break;
                                }
                                if (method_exists($res, $getterName)) {
                                    $entity = call_user_func([$res, $getterName]);

                                    if (array_key_exists(
                                        ClassUtils::getRealClass(get_class($entity)),
                                        config('railcontent.decorators')
                                    )) {
                                        $associationsDecorators =
                                            config('railcontent.decorators')[ClassUtils::getRealClass(
                                                get_class($entity)
                                            )];
                                        foreach ($associationsDecorators as $decorator) {
                                            $allDecorators[$decorator][$entity->getId()] = $entity;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        if (!empty($allDecorators)) {
            foreach ($allDecorators as $key => $value) {
                $decoratorInstance = app()->make($key);
                $decoratorInstance->decorate($value);
            }
        }

        return $objects;
    }
}
