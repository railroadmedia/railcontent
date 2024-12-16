<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Enums\VideoType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use App\Modules\Content\Models\Sanity\Structure\Validation\Required;
use Modules\Content\Models\Sanity\Structure\Block;
use Modules\Content\Models\Sanity\Structure\BrandField;
use Modules\Content\Models\Sanity\Structure\ListObject;

/**
 * Defines the schema structure for a Method document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class Method extends ParentTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Method', childName: 'Levels', withResources: true, withTrailer: true, withLogos: true);

        $detailsGroup = new Group('editorFields', 'Details', true);

        // Define child references
        $coursesChildReference = new Reference([['type' => "learning-path-level"],['type' => "course"], ['type' => "play-along"],  ['type' => "unit"]]);

        $this->addFields([
                             new Field(
                                 FieldType::Array,
                                 'child',
                                 'Child Items',
                                 group: $detailsGroup,
                                 of: $coursesChildReference,
                             ),
                         ]);
    }

    public static function getName(): string
    {
        return 'learning-path';
    }
}
