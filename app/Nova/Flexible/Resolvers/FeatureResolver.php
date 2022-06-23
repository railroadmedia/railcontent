<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\Feature;
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

            return $layout->duplicateAndHydrate($feature->id, [
                'desc' => $feature->desc,
                'id' => $feature->id,
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
           $features = $groups->map(function($group, $index){
              return [
                  'desc' => $group->getAttributes()['desc'],
                  'order_number' => $index,
                  'id' => isset($group->getAttributes()['id']) ? $group->getAttributes()['id'] : null
              ];
           });

            //update and insert items
            foreach($features as $feature){
                if(!is_null($feature['id'])){
                    $dbFeature = Feature::find($feature['id']);

                    if(empty($feature['desc'])){
                        $dbFeature->delete();
                    }
                    else {
                        if($dbFeature->desc !== $feature['desc']){
                            $dbFeature->desc = $feature['desc'];
                        }

                        if($dbFeature->order_number !== $feature['order_number']){
                            $dbFeature->order_number = $feature['order_number'];
                        }

                        $dbFeature->save();
                    }

                    $updatedIds[] = $feature['id'];
                }
                elseif(!empty($feature['desc'])){
                    $addFeature = new Feature();
                    $addFeature->product_id = $model['id'];
                    $addFeature->desc = $feature['desc'];
                    $addFeature->order_number = $feature['order_number'];
                    $addFeature->save();

                    $updatedIds[] = $addFeature->id;
                }
            }

           if(isset($updatedIds)){
               $deleteIds = Feature::where('product_id', '=', $model['id'])
                   ->whereNotIn('id', $updatedIds)->delete();
           }
        });
    }
}
