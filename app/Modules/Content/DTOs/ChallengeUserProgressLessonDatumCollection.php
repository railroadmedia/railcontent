<?php

namespace App\Modules\Content\DTOs;

use Illuminate\Support\Collection;

class ChallengeUserProgressLessonDatumCollection extends Collection
{
    public function __construct($elements = null)
    {
        $items = [];
        foreach ($elements as $element) {
            if (is_a($element, ChallengeUserProgressLessonDatum::class)) {
                $items[] = $element;
            } else {
                $items[] = new ChallengeUserProgressLessonDatum($element);
            }
        }
        parent::__construct($items);
    }
}
