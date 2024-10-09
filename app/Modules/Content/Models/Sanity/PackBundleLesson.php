<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a pack bundle lesson document type in Sanity.
 *
 */
class PackBundleLesson extends LessonTemplate
{
    public function __construct()
    {
        //TODO is the parent strictly pack-bundle, or do we need the ability to have challenge as well?
        parent::__construct(self::getName(), 'Pack Bundle Lesson', withResources: true, parentType: 'pack-bundle', isChallengeChild: true);
    }

    public static function getName(): string
    {
        return 'pack-bundle-lesson';
    }
}
