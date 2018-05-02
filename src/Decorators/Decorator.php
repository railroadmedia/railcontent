<?php

namespace Railroad\Railcontent\Decorators;


use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Support\Collection;

class Decorator
{
    /**
     * @param $data
     * @param $type
     * @param null $decoratorClass
     * @return mixed
     */
    public static function decorate($data, $type, $decoratorClass = null)
    {
        if (!empty(ConfigService::$decorators[$type]) || !empty($decoratorClass)) {

            if (empty($decoratorClass)) {
                $decoratorClassNames = ConfigService::$decorators[$type];
            } else {
                $decoratorClassNames = [$decoratorClass];
            }

            foreach ($decoratorClassNames as $decoratorClassName) {

                /**
                 * @var $decorator DecoratorInterface
                 */
                $decorator = app()->make($decoratorClassName);

                if (empty($data)) {
                    if (ConfigService::$useCollections) {
                        return new Collection($data);
                    } else {
                        return $data;
                    }
                }

                if (isset($data['id'])) {

                    // singular content
                    $data = $decorator->decorate([0 => $data])[0];
                } elseif (isset($data['results'])) {

                    // content is nested in results
                    if (isset($data['results']['id'])) {

                        // singular content
                        $data['results'] = $decorator->decorate([0 => $data['results']])[0];
                    } else {

                        // multiple contents
                        $data['results'] = $decorator->decorate($data['results']);
                    }
                } else {
                    // multiple contents
                    $data = $decorator->decorate($data);
                }
            }
        }

        if (ConfigService::$useCollections) {
            if (!empty($data['results'])) {

                // content is nested in results
                if (!isset($data['results']['id'])) {

                    // multiple contents
                    $data['results'] = new Collection($data['results']);
                }
            } else {
                // multiple contents
                $data = new Collection($data);
            }
        }

        return $data;
    }
}