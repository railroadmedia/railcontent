<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\LeadgenLesson;
use App\Models\LeadgenLessonAsset;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class LeadgenLessonResolver implements ResolverInterface
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
        $lessons = $resource->lessons()->get();

        return $lessons->map(function($lesson) use ($layouts) {
            $layout = $layouts->find('leadgen-lesson-layout');

            if(!$layout) return;

            return $layout->duplicateAndHydrate($lesson->id, [
                'title' => $lesson->title,
                'desc' => $lesson->desc,
                'thumbnail' => $lesson->thumbnail,
                'video_src' => $lesson->video_src,
                'display_order' => $lesson->display_order,
                'id' => $lesson->id,
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
        $class = get_class($model);

        $class::saved(function ($model) use ($groups){
            $lessons = $groups->map(function($group, $index) use($model){
               return [
                   'title' => $group->getAttributes()['title'],
                   'desc' => $group->getAttributes()['desc'],
                   'thumbnail' => $group->getAttributes()['thumbnail'],
                   'video_src' => $group->getAttributes()['video_src'],
                   'display_order' => $index,
                   'id' => isset($group->getAttributes()['id']) ? $group->getAttributes()['id'] : null,
                ];
            });

            $total = count(LeadgenLesson::where('leadgen_id', $model['id'])->get());

            foreach($lessons as $key => $lesson){
                //insert
                if(is_null($lesson['id'])){
                    $addLesson = new LeadgenLesson();
                    $addLesson->leadgen_id = $model['id'];
                    $addLesson->title = $lesson['title'];
                    $addLesson->desc = $lesson['desc'];
                    $addLesson->thumbnail = $lesson['thumbnail'];
                    $addLesson->video_src = $lesson['video_src'];
                    $addLesson->display_order = $key;
                    $addLesson->save();

                    $updatedIds[] = $addLesson->id;
                }
                //update
                else {
                    $updated = false;
                    $dbLesson = LeadgenLesson::find($lesson['id']);

                    if($dbLesson['title'] !== $lesson['title']){
                        $dbLesson->title = $lesson['title'];
                        $updated = true;
                    }

                    if($dbLesson['desc'] !== $lesson['desc']){
                        $dbLesson->desc = $lesson['desc'];
                        $updated = true;
                    }

                    if($dbLesson['thumbnail'] !== $lesson['thumbnail']){
                        $dbLesson->thumbnail = $lesson['thumbnail'];
                        $updated = true;
                    }

                    if($dbLesson['video_src'] !== $lesson['video_src']){
                        $dbLesson->video_src = $lesson['video_src'];
                        $updated = true;
                    }

                    if($dbLesson['display_order'] !== $lesson['display_order']){
                        $dbLesson->display_order = $key;
                        $updated = true;
                    }

                    $dbLesson->save();
                    if($updated === true) $updatedIds[] = $lesson['id'];
                }
            }

            //delete items
            if(isset($updatedIds) || count($lessons) !== $total){
                $deleteLessons = LeadgenLesson::select('id')->where('leadgen_id', $model['id'])->whereNotIn('id', isset($updatedIds) ? $updatedIds : []);
                if(count($deleteLessons->get()) > 0){
                    foreach($deleteLessons->get() as $id){
                        $assetIds[] = $id->id;
                    }
                    $deleteAssets = LeadgenLessonAsset::where('leadgen_lesson_id', $assetIds)->delete();
                    $deleteLessons->delete();
                }

            }
        });
    }
}
