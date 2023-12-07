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

        foreach ($contentsOfType as $contentIndex => $content) {
            $challengeEnrollStarted = Carbon::parse($content->fetch('fields.enrollment_start_time')) <= Carbon::now();
            $challengeEnrollEnded = Carbon::parse($content->fetch('fields.enrollment_end_time')) <= Carbon::now();
            $registrationUrl = $content->fetch('fields.registration_url');
            if($registrationUrl){
                $paths = explode('/', $registrationUrl);
                $contentsOfType[$contentIndex]['slug'] = \Arr::last($paths);
            }
            $enrollNow = $registrationUrl && $challengeEnrollStarted && !$challengeEnrollEnded;
            $notifyMe = Carbon::parse($content->fetch('fields.enrollment_start_time')) > Carbon::now();
            $normallAndAccessible = Carbon::parse($content->fetch('published_on')) <= Carbon::now();
            $contentsOfType[$contentIndex]['lesson_count'] = $content['child_count'];
            $contentsOfType[$contentIndex]['primary_cta_text'] = (!$challengeEnrollStarted)?'Notify Me':'Start Challenge';
            $contentsOfType[$contentIndex]['challenge_state'] = $enrollNow ? 'enrollment' : ($notifyMe ? 'upcoming' : ($normallAndAccessible ? 'accessible' : 'inaccessible'));
            $contentsOfType[$contentIndex]['challenge_state_text'] = $enrollNow ? 'Enroll Now' : ($notifyMe ? 'Notify Me' : $content['child_count'].' Workouts');
        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
