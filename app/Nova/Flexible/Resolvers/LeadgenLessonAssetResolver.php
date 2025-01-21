<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\Leadgen;
use App\Models\LeadgenLesson;
use App\Models\LeadgenLessonAsset;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class LeadgenLessonAssetResolver implements ResolverInterface
{
    public function get($resource, $attribute, $layouts)
    {
        $assets = [];
        if(!empty($resource['meta_desc'])) {
            $leadgen = Leadgen::where('id', $resource['id'])->find($resource['id']);
            if(!$leadgen) {
                return collect([]);
            }
            $assets = $leadgen->assets()->get();
        } else {
            $lesson = LeadgenLesson::where('id', $resource['id'])->find($resource['id']);
            if(!$lesson) {
                return collect([]);
            }
            $assets = $lesson->assets()->get();
        }

        $assets = !empty($lesson) ? $lesson->assets()->get() : $leadgen->assets()->get();

        return $assets->map(function ($asset) use ($layouts) {
            $layout = $layouts->find('leadgen-lesson-asset-layout');

            if(!$layout) {
                return;
            }

            return $layout->duplicateAndHydrate(
                $asset->id,
                [
                'title' => $asset->title,
                'src' => $asset->src,
                'soundslice' => $asset->soundslice,
                'id' => $asset->id,
                'leadgen_lesson_id' => $asset->leadgen_lesson_id
            ],
            );
        })->filter();
    }

    public function set($resource, $attribute, $groups)
    {
        $assets = $groups->map(function ($group, $index) {
            return [
                'title' => $group->getAttributes()['title'],
                'src' => $group->getAttributes()['src'],
                'soundslice' => $group->getAttributes()['soundslice'],
                'id' => !empty($group->getAttributes()['id']) ? $group->getAttributes()['id'] : null,
            ];
        });

        foreach($assets as $asset) {
            //insert
            if(is_null($asset['id']) && !is_null(empty($resource['id']))) {
                $addAsset = new LeadgenLessonAsset();
                $addAsset->leadgen_id = !empty($resource['meta_desc']) ? $resource['id'] : null;
                $addAsset->leadgen_lesson_id = empty($resource['meta_desc']) ? $resource['id'] : null;
                $addAsset->title = $asset['title'];
                $addAsset->src = $asset['src'];
                $addAsset->soundslice = $asset['soundslice'];
                $addAsset->save();
                $updatedIds[] = $addAsset->id;
            }
            //update
            else {
                $dbAsset = LeadgenLessonAsset::find($asset['id']);

                if($dbAsset['title'] !== $asset['title']) {
                    $dbAsset->title = $asset['title'];
                }

                if($dbAsset['src'] !== $asset['src']) {
                    $dbAsset->src = $asset['src'];
                }

                if($dbAsset['soundslice'] !== $asset['soundslice']) {
                    $dbAsset->soundslice = $asset['soundslice'];
                }

                $dbAsset->save();
                $updatedIds[] = $asset['id'];
            }
        }

        //delete
        if(!empty($resource['brand_id'])) {
            $deleteAssets = LeadgenLessonAsset::where('leadgen_id', $resource['id'])->whereNotIn('id', $updatedIds ?? [])->delete();
        } else {
            $deleteAssets = LeadgenLessonAsset::where('leadgen_lesson_id', $resource['id'])->whereNotIn('id', $updatedIds ?? [])->delete();
        }
    }
}
