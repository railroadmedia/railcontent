<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;

/**
 * Defines the schema structure for a Challenge document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Challenge extends ParentTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Challenge', childType: 'challenge-part', withLogos: true, withEnrollment:true) ;
    }

    public static function getName(): string
    {
        return 'challenge';
    }
}
