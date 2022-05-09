<?php

namespace App\Nova\Flexible\Resolvers;

use Whitecube\NovaFlexibleContent\Value\ResolverInterface;
use function Symfony\Component\Translation\t;

class SpecResolver implements ResolverInterface
{
    /**
     * get the field's value
     *
     * @param  mixed  $resource
     * @param  string $attribute
     * @param  Whitecube\NovaFlexibleContent\Layouts\Collection $layouts
     * @return Illuminate\Support\Collection
     */
    public function get($resource, $attribute, $layouts)
    {
        $specs = $resource->specs()->get();

        return $specs->map(function($spec) use ($layouts) {
            $layout = $layouts->find('spec-layout');

            if(!$layout) return;

            return $layout->duplicateAndHydrate($spec->id, [
                'title' => $spec->title,
                'desc' => $spec->desc,
            ]);
        })->filter();
    }

    /**
     * Set the field's value
     *
     * @param  mixed  $model
     * @param  string $attribute
     * @param  Illuminate\Support\Collection $groups
     * @return string
     */
    public function set($model, $attribute, $groups)
    {
        $class = get_class($model);

        $class::saved(function ($model) use ($groups){
            $specs = $groups->map(function($group, $index){
                return [
                    'title' => $group->getAttributes()['title'],
                    'desc' => $group->getAttributes()['desc'],
                ];
            });



            $model->specs()->delete();
            $model->specs()->createMany($specs);

        });
    }
}
