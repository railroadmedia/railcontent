<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\Spec;
use Laravel\Nova\Actions\Action;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;
use function Symfony\Component\Translation\t;

class SpecResolver implements ResolverInterface
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
        $specs = $resource->specs()->get();

        return $specs->map(function($spec) use ($layouts) {
            $layout = $layouts->find('spec-layout');

            if(!$layout) return;

            return $layout->duplicateAndHydrate($spec->id, [
                'title' => $spec->title,
                'desc' => $spec->desc,
                'id' => $spec->id,
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
            $specs = $groups->map(function($group, $index){
                return [
                    'title' => $group->getAttributes()['title'],
                    'desc' => $group->getAttributes()['desc'],
                    'id' => isset($group->getAttributes()['id']) ? $group->getAttributes()['id'] : null,
                    'order_number' => $index,
                ];
            });

            //update and insert items
            foreach ($specs as $spec){
                if(empty($spec['title']) || empty($spec['desc'])) {
                    abort(500, 'Title and description can\'t be empty');
                }
                else {
                    if(!is_null($spec['id'])){
                        $dbSpec = Spec::find($spec['id']);
                        if($dbSpec->title !== $spec['title'] || $dbSpec->desc !== $spec['desc']){
                            $dbSpec->title = $spec['title'];
                            $dbSpec->desc = $spec['desc'];
                        }

                        if($dbSpec->order_number !== $spec['order_number']){
                            $dbSpec->order_number = $spec['order_number'];
                        }
                        $dbSpec->save();
                        $updatedIds[] = $spec['id'];
                    }
                    else {
                        $addSpec = new Spec();
                        $addSpec->product_id = $model['id'];
                        $addSpec->title = $spec['title'];
                        $addSpec->desc = $spec['desc'];
                        $addSpec->order_number = $spec['order_number'];
                        $addSpec->save();

                        $updatedIds[] = $addSpec['id'];
                    }
                }
            }

            if(isset($updatedIds)){
                $deleteIds = Spec::where('product_id', '=', $model['id'])
                    ->whereNotIn('id', $updatedIds)->select('id')->delete();
            }
        });
    }
}
