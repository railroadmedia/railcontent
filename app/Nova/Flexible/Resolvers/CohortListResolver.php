<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\CohortList;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class CohortListResolver implements ResolverInterface
{
    public function get($resource, $attribute, $layouts)
    {
        $dropdowns = $resource->lists()->get();

        return $dropdowns->map(function ($dropdown) use ($layouts) {
            $layout = $layouts->find('cohort-list-layout');

            if(!$layout) {
                return;
            }


            return $layout->duplicateAndHydrate($dropdown->id, [
                'description' => $dropdown->description,
                'id' => $dropdown->id,
            ]);
        })->filter();
    }

    public function set($resource, $attribute, $groups)
    {
        $class = get_class($resource);

        $class::saved(function ($resource) use ($groups) {
            $dropdowns = $groups->map(function ($group, $index) {
                return [
                    'description' => $group->getAttributes()['description'],
                    'id' => isset($group->getAttributes()['id']) ? $group->getAttributes()['id'] : null
                ];
            });

            //update and insert items
            foreach($dropdowns as $dropdown) {
                if(!is_null($dropdown['id'])) {
                    $dbDropdown = CohortList::find($dropdown['id']);

                    if($dbDropdown->description !== $dropdown['description']) {
                        $dbDropdown->description = $dropdown['description'];
                    }

                    $dbDropdown->save();

                    $updatedIds[] = $dropdown['id'];
                } else {
                    $addDropdown = new CohortList();
                    $addDropdown->cohort_id = $resource['id'];
                    $addDropdown->description = $dropdown['description'];
                    $addDropdown->save();

                    $updatedIds[] = $addDropdown->id;
                }
            }

            if(isset($updatedIds)) {
                $deleteIds = CohortList::where('cohort_id', '=', $resource['id'])
                    ->whereNotIn('id', $updatedIds)->delete();
            }
        });
    }
}
