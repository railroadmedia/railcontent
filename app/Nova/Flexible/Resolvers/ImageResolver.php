<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class ImageResolver implements ResolverInterface
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
        $images = $resource->images()->get();

        return $images->map(function($image) use ($layouts) {
            $layout = $layouts->find('image-layout');

            if(!$layout) return;

            return $layout->duplicateAndHydrate($image->id, [
                'path_file' => $image->path,
                'path_text' => $image->path,
                'id' => $image->id
            ],
            );
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
            $images = $groups->map(function($group, $index) use($model){
                return [
                    'path' => !empty($group->getAttributes()['path_file']) ? $group->getAttributes()['path_file'] : $group->getAttributes()['path_text'],
                    'id' => isset($group->getAttributes()['id']) ? $group->getAttributes()['id'] : null,
                    'order_number' => $index
                ];
            });

            //update and insert items
            foreach($images as $image){
                if(!is_null($image['id'])) {
                    $dbImg = Image::find($image['id']);
                    if($dbImg->path !== $image['path']){
                        Storage::disk('nova_s3')->delete($dbImg->path);
                        Storage::disk('nova_s3')->put('/', $image['path']);

                        $dbImg->path = $image['path'];
                    }

                    if($dbImg->order_number !== $image['order_number']){
                        $dbImg->order_number = $image['order_number'];
                    }

                    $dbImg->save();

                     $updatedIds[] = $image['id'];
                }

                elseif(!empty($image['path'])) {
                    $addImg = new Image();
                    $addImg->path = $image['path'];
                    $addImg->product_id = $model['id'];
                    $addImg->order_number = $image['order_number'];
                    $addImg->save();

                    $updatedIds[] = $addImg->id;
                }
            }

            //delete items
            if(isset($updatedIds)){
                $imgs = Image::where('product_id', $model['id'])->whereNotIn('id', $updatedIds);
                if(count($imgs->get()) > 0){
                    foreach($imgs->get() as $img){
                        Storage::disk('nova_s3')->delete($img->path);
                    }

                    $imgs->delete();
                }
            }
        });
    }
}
