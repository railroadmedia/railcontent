<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\Benefit;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class BenefitResolver implements ResolverInterface
{
    public function get($resource, $attribute, $layouts)
    {
        $benefits = $resource->benefits()->get();

        return $benefits->map(function ($benefit) use ($layouts) {
            $layout = $layouts->find('benefit-layout');

            if(!$layout) {
                return null;
            }

            return $layout->duplicateAndHydrate($benefit->id, [
                'icon' => $benefit->icon,
                'heading' => $benefit->heading,
                'desc' => $benefit->desc,
                'id' => $benefit->id,
            ]);
        })->filter();
    }

    public function set($resource, $attribute, $groups)
    {
        $class = get_class($resource);

        $class::saved(function ($resource) use ($groups) {
            $benefits = $groups->map(function ($group, $index) {
                return [
                    'icon' => $group->getAttributes()['icon'],
                    'heading' => $group->getAttributes()['heading'],
                    'desc' => $group->getAttributes()['desc'],
                    'order_number' => $index,
                    'id' => isset($group->getAttributes()['id']) ? $group->getAttributes()['id'] : null
                ];
            });

            //update and insert items
            foreach ($benefits as $benefit) {
                if (!is_null($benefit['id'])) {
                    $dbBenefit = Benefit::find($benefit['id']);

                    if (empty($benefit['desc'])) {
                        $dbBenefit->delete();
                    } else {
                        if ($dbBenefit->desc !== $benefit['desc']) {
                            $dbBenefit->desc = $benefit['desc'];
                        }

                        if ($dbBenefit->order_number !== $benefit['order_number']) {
                            $dbBenefit->order_number = $benefit['order_number'];
                        }

                        $dbBenefit->save();
                    }

                    $updatedIds[] = $benefit['id'];
                } elseif (!empty($benefit['desc'])) {
                    $addBenefit = new Benefit();
                    $addBenefit->product_id = $resource['id'];
                    $addBenefit->icon = $benefit['icon'];
                    $addBenefit->heading = $benefit['heading'];
                    $addBenefit->desc = $benefit['desc'];
                    $addBenefit->order_number = $benefit['order_number'];
                    $addBenefit->save();

                    $updatedIds[] = $addBenefit->id;
                }
            }

            if (isset($updatedIds)) {
                $deleteIds = Benefit::where('product_id', '=', $resource['id'])
                    ->whereNotIn('id', $updatedIds)->delete();
            }
        });
    }
}
