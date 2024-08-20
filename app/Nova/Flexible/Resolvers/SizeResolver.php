<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\ProductSize;
use App\Models\Size;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class SizeResolver implements ResolverInterface
{
    public function get($resource, $attribute, $layouts)
    {
        $sizes = $resource->sizes()->get();

        return $sizes->map(function ($size) use ($layouts, $resource) {
            $layout = $layouts->find('size-layout');

            if(!$layout) {
                return;
            }

            return $layout->duplicateAndHydrate($size->id, [
                'size' => $size->name,
                'id' => $size->id
            ]);
        })->filter();
    }

    public function set($resource, $attribute, $groups): string
    {
        $class = get_class($resource);

        $class::saved(function ($resource) use ($groups) {
            $sizes = $groups->map(function ($group, $index) use ($resource) {
                return [
                    'size_id' => is_null($group->getAttributes()['size']) ? null : Size::firstWhere('name', $group->getAttributes()['size'])->id,
                    'id' => isset($group->getAttributes()['id']) ? $group->getAttributes()['id'] : null,
                ];
            });

            $sizeIds = [];

            foreach($sizes as $size) {
                if(!is_null($size['size_id'])) {
                    if(in_array($size['size_id'], $sizeIds)) {
                        abort(500, 'There are duplicated sizes');
                    }

                    array_push($sizeIds, $size['size_id']);

                    //update and insert items
                    if(!is_null($size['id'])) {
                        $dbSize = ProductSize::find($size['id']);
                        if($dbSize->size_id !== $size['size_id']) {
                            $dbSize->size_id = $size['size_id'];
                        }

                        $dbSize->save();
                        $updatedIds[] = $size['id'];
                    } else {
                        $addSize = new ProductSize();
                        $addSize->product_id = $resource['id'];
                        $addSize->size_id = $size['size_id'];
                        $addSize->save();

                        $updatedIds[] = $addSize->id;
                    }
                }
            }

            if(isset($updatedIds)) {
                $deleteIds = ProductSize::where("product_id", '=', $resource['id'])
                    ->whereNotIn('id', $updatedIds)->select('id')->get();

                ProductSize::destroy($deleteIds);
            }
        });
    }
}
