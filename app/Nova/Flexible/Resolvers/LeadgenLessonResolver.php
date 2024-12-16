<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\LeadgenLesson;
use App\Models\LeadgenLessonAsset;
use Illuminate\Support\Facades\Storage;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class LeadgenLessonResolver implements ResolverInterface
{
    public function get($resource, $attribute, $layouts)
    {
        $lessons = $resource->lessons()->get();

        return $lessons->map(function ($lesson) use ($layouts) {
            $layout = $layouts->find('leadgen-lesson-layout');

            if(!$layout) {
                return;
            }

            return $layout->duplicateAndHydrate(
                $lesson->id,
                [
                'title' => $lesson->title,
                'desc' => $lesson->desc,
                'caption' => $lesson->caption,
                'thumbnail_text' => $lesson->thumbnail,
                'thumbnail_file' => $lesson->thumbnail,
                'video_src' => $lesson->video_src,
                'display_order' => $lesson->display_order,
                'slug' => $lesson->slug,
                'duration' => $lesson->duration,
                'one_off' => $lesson->one_off,
                'id' => $lesson->id,
            ],
            );
        })->filter();
    }

    public function set($resource, $attribute, $groups)
    {
        $class = get_class($resource);

        $class::saved(function ($resource) use ($groups) {
            $lessons = $groups->map(function ($group, $index) use ($resource) {
                return [
                    'title' => $group->getAttributes()['title'],
                    'caption' => $group->getAttributes()['caption'],
                    'desc' => $group->getAttributes()['desc'],
                    'thumbnail' => !empty($group->getAttributes()['thumbnail_text']) ? $group->getAttributes()['thumbnail_text'] : $group->getAttributes()['thumbnail_file'],
                    'video_src' => $group->getAttributes()['video_src'],
                    'slug' => $group->getAttributes()['slug'],
                    'display_order' => $index + 1,
                    'duration' => $group->getAttributes()['duration'],
                    'one_off' => $group->getAttributes()['one_off'],
                    'id' => isset($group->getAttributes()['id']) ? $group->getAttributes()['id'] : null,
                 ];
            });

            foreach($lessons as $key => $lesson) {
                //insert
                if(is_null($lesson['id'])) {
                    if(!str_contains($lesson['thumbnail'], 'https')) {
                        $lesson['thumbnail'] = 'https://d1fyshwdvi6fth.cloudfront.net/'.$lesson['thumbnail'];
                    }

                    $addLesson = new LeadgenLesson();
                    $addLesson->leadgen_id = $resource['id'];
                    $addLesson->title = $lesson['title'];
                    $addLesson->caption = $lesson['caption'];
                    $addLesson->desc = $lesson['desc'];
                    $addLesson->slug = $lesson['slug'];
                    $addLesson->thumbnail = $lesson['thumbnail'];
                    $addLesson->video_src = $lesson['video_src'];
                    $addLesson->duration = $lesson['duration'];
                    $addLesson->display_order = $lesson['display_order'];
                    $addLesson->one_off = $lesson['one_off'];
                    $addLesson->save();

                    $updatedIds[] = $addLesson->id;
                }
                //update
                else {
                    $dbLesson = LeadgenLesson::find($lesson['id']);

                    if($dbLesson['title'] !== $lesson['title']) {
                        $dbLesson->title = $lesson['title'];
                    }

                    if($dbLesson['caption'] !== $lesson['caption']) {
                        $dbLesson->caption = $lesson['caption'];
                    }

                    if($dbLesson['desc'] !== $lesson['desc']) {
                        $dbLesson->desc = $lesson['desc'];
                    }

                    if($dbLesson['thumbnail'] !== $lesson['thumbnail']) {
                        $dbLesson->thumbnail = $lesson['thumbnail'];
                    }

                    if($dbLesson['video_src'] !== $lesson['video_src']) {
                        $dbLesson->video_src = $lesson['video_src'];
                    }

                    if($dbLesson['slug'] !== $lesson['slug']) {
                        $dbLesson->slug = $lesson['slug'];
                    }

                    if($dbLesson['duration'] !== $lesson['duration']) {
                        $dbLesson->duration = $lesson['duration'];
                    }

                    if($dbLesson['display_order'] !== $lesson['display_order']) {
                        $dbLesson->display_order = $lesson['display_order'];
                    }

                    if($dbLesson['one_off'] !== $lesson['one_off']) {
                        $dbLesson->one_off = $lesson['one_off'];
                    }

                    $dbLesson->save();
                    $updatedIds[] = $lesson['id'];
                }
            }

            //delete items
            $deleteLessons = LeadgenLesson::where('leadgen_id', $resource['id'])->whereNotIn('id', $updatedIds ?? []);
            if(count($deleteLessons->get()) > 0) {
                foreach($deleteLessons->get() as $id) {
                    Storage::disk('nova_s3')->delete(str_replace('https://d1fyshwdvi6fth.cloudfront.net/', '', $id->thumbnail));
                    $assetIds[] = $id->id;
                }
                $deleteAssets = LeadgenLessonAsset::where('leadgen_lesson_id', $assetIds)->delete();
                $deleteLessons->delete();
            }
        });
    }
}
