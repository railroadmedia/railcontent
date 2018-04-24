<?php

namespace Railroad\Railcontent\Decorators;


use Railroad\Railcontent\Services\ConfigService;

class Decorator implements DecoratorInterface
{
    /**
     * @var string
     */
    public $type;

    /**
     * @param $data
     * @return mixed
     */
    public function decorate($data)
    {
        if (!empty(ConfigService::$decorators[$this->type])) {
            foreach (ConfigService::$decorators[$this->type] as $decoratorClass) {

                /**
                 * @var $decorator DecoratorInterface
                 */
                $decorator = app()->make($decoratorClass);

                if (empty($data)) {
                    return $data;
                }

                if (isset($data['id'])) {
                    $data = $decorator->decorate($data);

                    continue;
                }

                if (!empty($data['results'])) {
                    $data['results'] = $decorator->decorate($data['results']);
                } else {
                    $data = $decorator->decorate($data);
                }
            }
        }

        return $data;
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}