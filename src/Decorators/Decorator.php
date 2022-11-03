<?php

namespace Railroad\Railcontent\Decorators;

use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Support\Collection;

class Decorator
{
    public static bool $typeDecoratorsEnabled = true;

    /**
     * @param $data
     * @param $type
     * @param null $decoratorClass
     * @return mixed
     */
    public static function decorate($data, $type, $decoratorClass = null)
    {
        if(is_null($data)){
            return $data;
        }

        if (isset($data['results'])) {

            // content is nested in results
            if (!isset($data['results']['id'])) {

                // multiple contents
                $data['results'] = new Collection($data['results']);
            }
        } elseif (empty($data['id'])) {

            // multiple contents
            $data = new Collection($data);
        }

        if (!empty(ConfigService::$decorators[$type]) || !empty($decoratorClass)) {

            if (empty($decoratorClass)) {
                $decoratorClassNames = ConfigService::$decorators[$type];
            } else {
                $decoratorClassNames = [$decoratorClass];
            }

            if (!self::$typeDecoratorsEnabled) {
                $decoratorClassNames = [
                    \Railroad\Railcontent\Decorators\UserProgress\ContentUserProgressDecorator::class,
                    \Railroad\Railcontent\Decorators\Entity\ContentEntityDecorator::class,
                    \Railroad\Railcontent\Decorators\Entity\AddedToPrimaryPlaylistDecorator::class,
                ];
            }

            foreach ($decoratorClassNames as $decoratorClassName) {

                /**
                 * @var $decorator DecoratorInterface
                 */
                $decorator = app()->make($decoratorClassName);

                if (empty($data)) {
                    return new Collection($data);
                }

                if (isset($data['id'])) {

                    // singular content
                    $data =
                        $decorator->decorate(new Collection([$data]))
                            ->first();

                } elseif (isset($data['results'])) {

                    // content is nested in results
                    if (isset($data['results']['id'])) {

                        // singular content
                        $data['results'] =
                            $decorator->decorate(new Collection([$data]))
                                ->first();
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
