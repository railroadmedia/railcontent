<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\Size;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class SizeResolver implements ResolverInterface
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
        $sizes = $resource->sizes()->get();

        return $sizes->map(function($size) use ($layouts) {
            $layout = $layouts->find('size-layout');

            if(!$layout) return;

            return $layout->duplicateAndHydrate($size->id, [
                'size' => $size->name,
                'sold_out' => $size->sold_out
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
            $sizes = $groups->map(function($group, $index) use($model){
                return [
                    'size_id' => Size::firstWhere('name', $group->getAttributes()['size'])->id,
                    'sold_out' => $group->getAttributes()['sold_out']
                ];
            });

            $model->product_size()->delete();
            $model->product_size()->createMany($sizes);

        });
    }
}
