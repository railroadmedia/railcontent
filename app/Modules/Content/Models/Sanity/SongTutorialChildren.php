<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;

/**
 * Defines the schema structure for a Song tutorial children document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class SongTutorialChildren extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Song Tutorial Children', withResources: true);
        $detailsGroup = new Group('editorFields', 'Details', true);
        $this->addFields([
                             new Field(FieldType::Reference, 'artist', 'Artist', '', to: 'artist', options: ['aiAssist' => ['embeddingsIndex' => 'artists-index']], group:$detailsGroup),
        ]);
    }

    public static function getName(): string
    {
        return 'song-tutorial-children';
    }
}
