<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;

/**
 * Defines the schema structure for a Rudiment document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class Rudiment extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Rudiments', withResources: true);

        $detailsGroup = new Group('editorFields', 'Details', true);
        $this->addFields([
                             new Field(FieldType::URL, 'sheet_music_thumbnail_url', 'sheet_music_thumbnail_url', group: $detailsGroup),
                             new Field(FieldType::String, 'gear', 'Instrument', group: $detailsGroup)
                         ]);
    }


    public static function getName(): string
    {
        return 'rudiment';
    }
}
