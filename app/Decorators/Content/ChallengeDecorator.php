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
            $challengeStarted = Carbon::parse($content->fetch('data.enrollment_start_time')) > Carbon::now();
//            $challengePermissions = (\Arr::pluck($content['permissions'],'permission_id'));
//            $isEnrolled = $challengeStarted && auth()->check() && auth()->user()->isEnrolledInCohort($challengePermissions);
            $contentsOfType[$contentIndex]['lesson_count'] = $content['child_count'];
            $contentsOfType[$contentIndex]['primary_cta_text'] = ($challengeStarted)?'Notify Me':'Start Challenge';

        }

        return $this->mergeDecorated($contents, $contentsOfType);
    }
}
