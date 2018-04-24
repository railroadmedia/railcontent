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