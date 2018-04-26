<?php

namespace Railroad\Railcontent\Decorators;


use Railroad\Railcontent\Services\ConfigService;

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
                    return $data;
                }

                if (isset($data['id'])) {

                    // singular content
                    $data = $decorator->decorate([0 => $data])[0];
                } elseif (!empty($data['results'])) {

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

        return $data;
    }
}