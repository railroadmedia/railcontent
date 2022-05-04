<?php

namespace App\Nova\Flexible\Resolvers;

use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class FeatureResolver implements ResolverInterface
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
        $features = $resource->features()->get();

        return $features->map(function($feature) use ($layouts) {
            $layout = $layouts->find('feature-layout');

            if(!$layout) return;

            return $layout->duplicateAndHydrate($feature->id, ['desc' => $feature->desc]);
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
           $features = $groups->map(function($group, $index){
              return [
                  'desc' => $group->getAttributes()['desc'],
                  'order' => $index
              ];
           });



            $model->features()->delete();
            $model->features()->createMany($features);

        });
    }
}
