<?php

namespace App\Maps;

class ContentTypeHierarchyMap
{
    /**
     * parent type => child type
     * @var string[]
     */
    public static array $map = [
        'learning-path' => 'learning-path-level',
        'learning-path-level' => 'learning-path-course',
        'learning-path-course' => 'learning-path-lesson',
        'unit' => 'unit-part',
        'song' => 'song-part',
        'course' => 'course-part',
        'pack' => 'pack-bundle',
        'pack-bundle' => 'pack-bundle-lesson',
    ];
}
