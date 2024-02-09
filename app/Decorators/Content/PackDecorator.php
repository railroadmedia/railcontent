<?php

namespace App\Decorators\Content;

use Carbon\Carbon;
use Railroad\Railcontent\Support\Collection;

class PackDecorator extends TypeDecoratorBase
{
    public static $skip = false;

    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->where('type', 'pack');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }

        foreach ($contentsOfType as $contentIndex => $content) {
            if (($content['completed'] ?? false) !== true) {
                $contentsOfType[$contentIndex]['next_lesson_url'] =
                    url()->route('platform.content.jump-to-continue-content', [$content['id']]);
                $contentsOfType[$contentIndex]['mobile_next_lesson_url'] =
                    url()->route('platform.content.jump-to-continue-content', [$content['id']]);
            }
            $enrollStarted = !empty($content->fetch('enrollment_start_time')) && Carbon::parse($content->fetch('enrollment_start_time')) <= Carbon::now();
            $enrollEnded = !empty($content->fetch('enrollment_end_time')) && Carbon::parse($content->fetch('enrollment_end_time')) <= Carbon::now();
            $registrationUrl = $content->fetch('fields.registration_url');
            $enrollNow = $registrationUrl && $enrollStarted && !$enrollEnded;
            $contentsOfType[$contentIndex]['enrollment_state'] = $enrollNow ? 'open' : 'closed';

            if($enrollNow){
                $contentsOfType[$contentIndex]['badge_text'] = 'Enroll Now!';
                $ctaRequest = \Request::create($registrationUrl);

                $lastSegment = last($ctaRequest->segments());
                $cohort = $this->cohortService->getCohort($lastSegment);

                $productId = $cohort['product_id'];
                $product = $this->productService->getById($productId);

                $contentPermissionsLookup = $this->contentPermissionsService->getContentPermissionsLookup();
                $permissionID =
                    $product->getContentPermissions($contentPermissionsLookup)
                        ->first()->id ?? null;
                $hasProduct = user() && $this->userAccessPermissionsService->hasPermission(user()?->id, $permissionID);
                if($hasProduct){
                    $enrollNow = false;
                    $contentsOfType[$contentIndex]['enrollment_state'] = 'enrolled';
                    $contentsOfType[$contentIndex]['badge_text'] = "You're enrolled!";
                }
            }
            $isStarted = $content['started'] && !$content['completed'];
            $isCompleted = $content['completed'];
            $contentsOfType[$contentIndex]['primary_cta_text'] = $enrollNow ? 'Enroll Now' : ((!$isStarted) ? 'Start' : (($isCompleted) ? 'Completed' : ' Continue'));
            $contentsOfType[$contentIndex]['primary_cta_url'] = $enrollNow ? $registrationUrl : $contentsOfType[$contentIndex]['next_lesson_url'];

            if ($content['slug'] === '30-day-drummer') {
                $contentsOfType[$contentIndex]['launch_date'] = 'September 2022';
            } elseif ($content['slug'] === '30-day-drummer-season-2') {
                $contentsOfType[$contentIndex]['launch_date'] = 'March 2023';
            } elseif ($content['slug'] === '30-day-drummer-season-3') {
                $contentsOfType[$contentIndex]['launch_date'] = 'September 2023';
            }

            //strip <p> tags from description
            $contentData = $content['data'] ?? [];
            foreach ($contentData as $index => $data) {
                if(in_array($data['key'] ,['description'])){
                    $contentsOfType[$contentIndex]['data'][$index]['value'] = strip_tags(html_entity_decode($data['value']), '<a>,<em>,<strong>');
                }
            }

        }

        if (self::$skip) {
            return $this->mergeDecorated($contents, $contentsOfType);
        }

        $childCounts = $this->contentHierarchyService->countParentsChildren(
            $contents->pluck('id')
                ->toArray()
        );

        $packBundlesHierarchies = $this->contentHierarchyService->getByParentIds(
            $contents->pluck('id')
                ->toArray()
        );

        $packBundleLessonsHierarchies = $this->contentHierarchyService->getByParentIds(
            array_column($packBundlesHierarchies, 'child_id')
        );

        foreach ($contentsOfType as $contentIndex => $content) {
            $contentsOfType[$contentIndex]['xp'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.pack_content_completed')
            );
            $contentsOfType[$contentIndex]['xp_bonus'] = $content->fetch(
                'fields.xp',
                config('xp_ranks.pack_content_completed')
            );


            $contentsOfType[$contentIndex]['bundle_count'] = $childCounts[$content['id']] ?? 0;
            $allLessons = 0;
            foreach ($packBundlesHierarchies as $packBundlesHierarchy) {
                if ($packBundlesHierarchy['parent_id'] == $content['id']) {
                    $contentsOfType[$contentIndex]['xp'] += config('xp_ranks.pack_bundle_content_completed');

                    foreach ($packBundleLessonsHierarchies as $packBundleLessonsHierarchy) {
                        if ($packBundleLessonsHierarchy['parent_id'] == $packBundlesHierarchy['child_id']) {
                            $allLessons++;
                            $contentsOfType[$contentIndex]['xp'] += config('xp_ranks.difficulty_xp_map.all');
                        }
                    }
                }
            }
            $contentsOfType[$contentIndex]['lesson_count'] = $allLessons;
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
