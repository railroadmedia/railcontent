<?php

namespace App\Maps;

class PrimaryURLSlugToContentTypeMap
{
    /**
     * @var string[]
     */
    public static array $map = [
        'method' => 'learning-path',
        'courses' => 'course',
        'songs' => 'song',
        'quick-tips' => 'quick-tips',
        'question-and-answer' => 'question-and-answer',
        'student-reviews' => 'student-review',
        'bootcamps' => 'boot-camps',
        'chords-and-scales' => 'chord-and-scale',
        'podcasts' => 'podcasts',
    ];
}
