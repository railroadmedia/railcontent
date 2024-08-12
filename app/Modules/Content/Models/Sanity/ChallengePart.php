<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Enums\VideoType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use Modules\Content\Models\Sanity\Structure\BrandField;
use Modules\Content\Models\Sanity\Structure\ListObject;

/**
 * Defines the schema structure for a Challenge part document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class ChallengePart extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Challenge Part');

        // Add the reference to the parent course
        $detailsGroup = new Group('editorFields', 'Details', true);
        $this->addFields([
                             new Field(FieldType::String, 'soundslice_slug', group: $detailsGroup),
                             new Field(FieldType::Reference, name: 'parent', title: 'Parent', to: 'challenge', group:$detailsGroup)
                         ]);
    }

    public static function getName(): string
    {
        return 'challenge-part';
    }
}
