<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\Leadgen;
use App\Models\LeadgenLesson;
use App\Models\LeadgenLessonAsset;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class LeadgenLessonAssetResolver implements ResolverInterface
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
        $assets = [];
        if(!empty($resource['meta_desc'])){
            $leadgen = Leadgen::where('id', $resource['id'])->find($resource['id']);
            if(!$leadgen) return collect([]);
            $assets = $leadgen->assets()->get();
        }
        else {
            $lesson = LeadgenLesson::where('id', $resource['id'])->find($resource['id']);
            if(!$lesson) return collect([]);
            $assets = $lesson->assets()->get();
        }

        $assets = !empty($lesson) ? $lesson->assets()->get() : $leadgen->assets()->get();

        return $assets->map(function($asset) use ($layouts) {
            $layout = $layouts->find('leadgen-lesson-asset-layout');

            if(!$layout) return;

            return $layout->duplicateAndHydrate($asset->id, [
                'title' => $asset->title,
                'src' => $asset->src,
                'soundslice' => $asset->soundslice,
                'id' => $asset->id,
                'leadgen_lesson_id' => $asset->leadgen_lesson_id
            ],
            );
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
       $assets = $groups->map(function($group, $index){
         return [
             'title' => $group->getAttributes()['title'],
             'src' => $group->getAttributes()['src'],
             'soundslice' => $group->getAttributes()['soundslice'],
             'id' => !empty($group->getAttributes()['id']) ? $group->getAttributes()['id'] : null,
         ];
       });

       foreach($assets as $asset){
           //insert
           if(is_null($asset['id'])){
               $addAsset = new LeadgenLessonAsset();
               $addAsset->leadgen_lesson_id = $model['id'];
               $addAsset->title = $asset['title'];
               $addAsset->src = $asset['src'];
               $addAsset->soundslice = $asset['soundslice'];
               $addAsset->save();
               $updatedIds[] = $addAsset->id;
           }
           //update
           else {
               $dbAsset = LeadgenLessonAsset::find($asset['id']);

               if($dbAsset['title'] !== $asset['title']){
                   $dbAsset->title = $asset['title'];
               }

               if($dbAsset['src'] !== $asset['src']){
                   $dbAsset->src = $asset['src'];
               }

               if($dbAsset['soundslice'] !== $asset['soundslice']){
                   $dbAsset->soundslice = $asset['soundslice'];
               }

               $dbAsset->save();
               $updatedIds[] = $asset['id'];
           }
       }

       //delete
        if(isset($updatedIds)){
            $deleteAssets = LeadgenLessonAsset::where('leadgen_lesson_id', $model['id'])->whereNotIn('id', $updatedIds)->delete();
        }
    }
}
