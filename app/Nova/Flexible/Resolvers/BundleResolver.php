<?php

namespace App\Nova\Flexible\Resolvers;

use Whitecube\NovaFlexibleContent\Layouts\Collection;
use Illuminate\Support\Collection;
use App\Models\Bundle;
use App\Models\Product;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class BundleResolver implements ResolverInterface
{
    /**
     * get the field's value
     *
     * @param  mixed  $resource
     * @param  string $attribute
     * @param  Whitecube\NovaFlexibleContent\Layouts\Collection $layouts
     * @return Illuminate\Support\Collection
     */
    public function get($resource, string $attribute, Collection $layouts): Collection
    {
        $bundles = $resource->bundles()->get();

        return $bundles->map(function ($bundle) use ($layouts) {
            $layout = $layouts->find('bundle-layout');

            if(!$layout) {
                return;
            }

            return $layout->duplicateAndHydrate($bundle->id, [
                'product' => $bundle->name,
                'free_bonus' => $bundle->free_bonus,
                'lifetime_access' => $bundle->lifetime_access,
                'id' => $bundle->id ?: null,
            ]);
        });

    }

    /**
     * Set the field's value
     *
     * @param  mixed  $model
     * @param  string $attribute
     * @param  Illuminate\Support\Collection $groups
     * @return string
     */
    public function set($model, string $attribute, Collection $groups): string
    {
        $class = get_class($model);

        $class::saved(function ($model) use ($groups) {
            foreach($groups as $key => $group) {
                //update
                if(!is_null($group['id'])) {
                    $dbBundle = Bundle::find($group['id']);
                    $updatedIds[] = $group['id'];

                    if(empty($group['product'])) {
                        $dbBundle->delete();
                    } else {
                        $product_id = Product::where('name', $group['product'])->first()->id;
                        if($dbBundle->name !== $product_id) {
                            $dbBundle->product_id = $product_id;
                        }

                        if($dbBundle->order_number !== $key) {
                            $dbBundle->order_number = $key;
                        }

                        if($dbBundle->free_bonus !== $group['free_bonus']) {
                            $dbBundle->free_bonus = $group['free_bonus'];
                        }

                        if($dbBundle->lifetime_access !== $group['lifetime_access']) {
                            $dbBundle->lifetime_access = $group['lifetime_access'];
                        }

                        $dbBundle->save();
                    }
                }
                //create
                elseif(!empty($group['product'])) {
                    $product_id = Product::where('name', $group['product'])->first()->id;

                    if(!is_null($product_id)) {
                        $addBundle = new Bundle();
                        $addBundle->bundle_id = $model['id'];
                        $addBundle->product_id = $product_id;
                        $addBundle->free_bonus = $group['free_bonus'];
                        $addBundle->lifetime_access = $group['lifetime_access'];
                        $addBundle->order_number = $key;
                        $addBundle->save();

                        $updatedIds[] = $addBundle->id;
                    }
                }
            }

            if(isset($updatedIds)) {
                Bundle::where('bundle_id', $model['id'])->whereNotIn('id', $updatedIds)->delete();
            }
        });
    }
}
