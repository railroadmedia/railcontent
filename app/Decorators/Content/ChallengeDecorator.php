<?php

namespace App\Decorators\Content;

use Carbon\Carbon;
use Railroad\Railcontent\Support\Collection;

class ChallengeDecorator extends TypeDecoratorBase
{
    /**
     * @param Collection $contents
     * @return Collection
     */
    public function decorate(Collection $contents)
    {
        $contentsOfType = $contents->where('type', 'challenge');

        if ($contentsOfType->isEmpty()) {
            return $contents;
        }
        $contentPermissionsLookup = $this->contentPermissionsService->getContentPermissionsLookup();

        foreach ($contentsOfType as $contentIndex => $content) {
            $challengeEnrollStarted = !empty($content->fetch('enrollment_start_time')) && Carbon::parse($content->fetch('enrollment_start_time')) <= Carbon::now();
            $challengeEnrollEnded = !empty($content->fetch('enrollment_end_time')) && Carbon::parse($content->fetch('enrollment_end_time')) <= Carbon::now();
            $registrationUrl = $content->fetch('fields.registration_url');
            $cohortSlug = '';
            if($registrationUrl){
                $paths = explode('/', $registrationUrl);
                $cohortSlug = \Arr::last($paths);
            }
            if(config('musora-api.api.version')){
                $contentsOfType[$contentIndex]['slug'] = $cohortSlug;
            }

            $cohort = $this->cohortService->getCohort($cohortSlug);
            if($cohort) {
                $productId = $cohort['product_id'];
                $product = $this->productService->getById($productId);
                $permissionID =
                    $product->getContentPermissions($contentPermissionsLookup)
                        ->first()->id ?? null;
                $contentsOfType[$contentIndex]['has_product'] = (!$permissionID)?true:(user() && $this->userAccessPermissionsService->hasPermission(user()?->id, $permissionID));
            }

            $enrollNow = $registrationUrl && $challengeEnrollStarted && !$challengeEnrollEnded;
            $notifyMe = !empty($content->fetch('enrollment_start_time')) && Carbon::parse($content->fetch('enrollment_start_time')) > Carbon::now();

            $normallAndAccessible = !empty($content->fetch('published_on')) && Carbon::parse($content->fetch('published_on')) <= Carbon::now();
            $contentsOfType[$contentIndex]['lesson_count'] = $content['child_count'];
            $contentsOfType[$contentIndex]['primary_cta_text'] = (!$challengeEnrollStarted && !$normallAndAccessible)?'Notify Me':'Start Challenge';
            $contentsOfType[$contentIndex]['challenge_state'] = $enrollNow ? 'enrollment' : ($notifyMe ? 'upcoming' : ($normallAndAccessible ? 'accessible' : 'inaccessible'));
            $contentsOfType[$contentIndex]['challenge_state_text'] = $enrollNow ? 'Enroll Now' : ($notifyMe ? 'Notify Me' : $content['child_count'].' Workouts');
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
