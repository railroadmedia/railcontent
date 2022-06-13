<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\ProductSize;
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

        return $sizes->map(function($size) use ($layouts, $resource) {
            $layout = $layouts->find('size-layout');

            if(!$layout) return;

            return $layout->duplicateAndHydrate($size->id, [
                'size' => $size->name,
                'sold_out' => $size->sold_out,
                'id' => ProductSize::where('product_id', '=', $resource['id'])->where('size_id', '=', $size['id'])->first()->id
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
                    'size_id' => is_null($group->getAttributes()['size']) ? null : Size::firstWhere('name', $group->getAttributes()['size'])->id,
                    'sold_out' => $group->getAttributes()['sold_out'],
                    'id' => isset($group->getAttributes()['id']) ? $group->getAttributes()['id'] : null,
                ];
            });

            $sizeIds = array();

            foreach($sizes as $size){
                if(!is_null($size['size_id'])){
                    if(in_array($size['size_id'], $sizeIds)){
                        dd('the size already exists');
                    }

                    array_push($sizeIds, $size['size_id']);

                    //update and insert items
                    if(!is_null($size['id'])){
                        $dbSize = ProductSize::find($size['id']);
                        if($dbSize->size_id !== $size['size_id']){
                            $dbSize->size_id = $size['size_id'];
                        }

                        if($dbSize->sold_out !== $size['sold_out']){
                            $dbSize->sold_out = $size['sold_out'];
                        }

                        $dbSize->save();
                        $updatedIds[] = $size['id'];
                    }
                    else {
                        $addSize = new ProductSize();
                        $addSize->product_id = $model['id'];
                        $addSize->size_id = $size['size_id'];
                        $addSize->sold_out = $size['sold_out'];
                        $addSize->save();

                        $updatedIds[] = $addSize->id;
                    }
                }
            }

            if(isset($updatedIds)){
                $deleteIds = ProductSize::where("product_id", '=', $model['id'])
                    ->whereNotIn('id', $updatedIds)->select('id')->get();

                ProductSize::destroy($deleteIds);
            }
        });
    }
}
