<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\CohortDropdown;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class CohortDropdownResolver implements ResolverInterface
{
    /**
     * get the field's value
     *
     * @param  mixed  $resource
     * @param  string $attribute
     * @param  \Whitecube\NovaFlexibleContent\Layouts\Collection $layouts
     * @return \Illuminate\Support\Collection
     */
    public function get($resource, $attribute, $layouts)
    {
        $dropdowns = $resource->dropdowns()->get();

        return $dropdowns->map(function ($dropdown) use ($layouts) {
            $layout = $layouts->find('cohort-dropdown-layout');

            if(!$layout) {
                return;
            }

            return $layout->duplicateAndHydrate($dropdown->id, [
                'title' => $dropdown->title,
                'description' => $dropdown->description,
                'id' => $dropdown->id,
            ]);
        })->filter();
    }

    /**
     * Set the field's value
     *
     * @param  mixed  $model
     * @param  string $attribute
     * @param  \Illuminate\Support\Collection $groups
     * @return string
     */
    public function set($model, $attribute, $groups)
    {
        $class = get_class($model);

        $class::saved(function ($model) use ($groups) {
            $dropdowns = $groups->map(function ($group, $index) {
                return [
                    'title' => $group->getAttributes()['title'],
                    'description' => $group->getAttributes()['description'],
                    'id' => isset($group->getAttributes()['id']) ? $group->getAttributes()['id'] : null
                ];
            });

            //update and insert items
            foreach($dropdowns as $dropdown) {
                if(!is_null($dropdown['id'])) {
                    $dbDropdown = CohortDropdown::find($dropdown['id']);

                    if($dbDropdown->title !== $dropdown['title']) {
                        $dbDropdown->title = $dropdown['title'];
                    }

                    if($dbDropdown->description !== $dropdown['description']) {
                        $dbDropdown->description = $dropdown['description'];
                    }

                    $dbDropdown->save();

                    $updatedIds[] = $dropdown['id'];
                } else {
                    $addDropdown = new CohortDropdown();
                    $addDropdown->cohort_id = $model['id'];
                    $addDropdown->title = $dropdown['title'];
                    $addDropdown->description = $dropdown['description'];
                    $addDropdown->save();

                    $updatedIds[] = $addDropdown->id;
                }
            }

            if(isset($updatedIds)) {
                $deleteIds = CohortDropdown::where('cohort_id', '=', $model['id'])
                    ->whereNotIn('id', $updatedIds)->delete();
            }
        });
    }
}
