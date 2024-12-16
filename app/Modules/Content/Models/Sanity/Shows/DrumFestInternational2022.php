<?php

namespace App\Modules\Content\Models\Sanity\Shows;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Enums\VideoType;
use App\Modules\Content\Models\Sanity\LessonTemplate;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use Modules\Content\Models\Sanity\Structure\Block;
use Modules\Content\Models\Sanity\Structure\BrandField;
use Modules\Content\Models\Sanity\Structure\ListObject;

/**
 * Defines the schema structure for a Drum Fest International 2022 document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class DrumFestInternational2022 extends LessonTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), '2022 Drum Fest International');
    }

    public static function getName(): string
    {
        return 'drum-fest-international-2022';
    }
}
