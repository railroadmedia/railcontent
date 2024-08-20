<?php

namespace App\Nova\Flexible\Resolvers;

use App\Models\LeadgenLesson;
use App\Models\LeadgenLessonAssignment;
use Whitecube\NovaFlexibleContent\Value\ResolverInterface;

class LeadgenLessonAssignmentResolver implements ResolverInterface
{
    public function get($resource, $attribute, $layouts)
    {
        $lesson = LeadgenLesson::where('id', $resource['id'])->find($resource['id']);
        if(!$lesson) {
            return collect([]);
        }
        $assignments = $lesson->assignments()->get();

        return $assignments->map(function ($assignment) use ($layouts) {
            $layout = $layouts->find('leadgen-lesson-assignment-layout');

            if(!$layout) {
                return;
            }

            return $layout->duplicateAndHydrate(
                $assignment->id,
                [
                'title' => $assignment->title,
                'subtitle' => $assignment->subtitle,
                'src' => $assignment->src,
                'soundslice' => $assignment->soundslice,
                'id' => $assignment->id,
                'leadgen_lesson_id' => $assignment->leadgen_lesson_id
            ],
            );
        })->filter();
    }

    public function set($resource, $attribute, $groups)
    {

        $assignments = $groups->map(function ($group, $index) {
            return [
                'title' => $group->getAttributes()['title'],
                'subtitle' => $group->getAttributes()['subtitle'],
                'src' => $group->getAttributes()['src'],
                'soundslice' => $group->getAttributes()['soundslice'],
                'id' => !empty($group->getAttributes()['id']) ? $group->getAttributes()['id'] : null,
            ];
        });

        foreach($assignments as $assignment) {
            //insert
            if(is_null($assignment['id'])) {
                $addAssignment = new LeadgenLessonAssignment();
                $addAssignment->leadgen_lesson_id = $resource->id;
                $addAssignment->title = $assignment['title'];
                $addAssignment->subtitle = $assignment['subtitle'];
                $addAssignment->src = $assignment['src'];
                $addAssignment->soundslice = $assignment['soundslice'];
                $addAssignment->save();
                $updatedIds[] = $addAssignment->id;
            }
            //update
            else {
                $dbAssignment = LeadgenLessonAssignment::find($assignment['id']);

                if($dbAssignment['title'] !== $assignment['title']) {
                    $dbAssignment->title = $assignment['title'];
                }

                if($dbAssignment['subtitle'] !== $assignment['subtitle']) {
                    $dbAssignment->subtitle = $assignment['subtitle'];
                }

                if($dbAssignment['src'] !== $assignment['src']) {
                    $dbAssignment->src = $assignment['src'];
                }

                if($dbAssignment['soundslice'] !== $assignment['soundslice']) {
                    $dbAssignment->soundslice = $assignment['soundslice'];
                }

                $dbAssignment->save();
                $updatedIds[] = $assignment['id'];
            }
        }

        //delete
        $deleteAssignments = LeadgenLessonAssignment::where('leadgen_lesson_id', $resource['id'])->whereNotIn('id', $updatedIds ?? [])->delete();
    }
}
