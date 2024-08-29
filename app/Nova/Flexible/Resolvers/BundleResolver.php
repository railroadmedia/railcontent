<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\Bundle;
use App\Models\Product;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class BundleResolver implements ResolverInterface
{
    public function get($resource, $attribute, $layouts)
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

    public function set($resource, $attribute, $groups)
    {
        $class = get_class($resource);

        $class::saved(function ($resource) use ($groups) {
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
                        $addBundle->bundle_id = $resource['id'];
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
                Bundle::where('bundle_id', $resource['id'])->whereNotIn('id', $updatedIds)->delete();
            }
        });
    }
}
