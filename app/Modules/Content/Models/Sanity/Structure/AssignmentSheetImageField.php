<?php

namespace Modules\Content\Models\Sanity\Structure;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;

/**
 * A field of a Sanity CMS document used for Assignment Sheet Image
 */
class AssignmentSheetImageField extends Field
{
    /**
     * @param  Group|array<Group>|null  $group
     */
    public function __construct(
        public Group|array|null $group = null,
    ) {
        parent::__construct(
            FieldType::Array,
            'assignment_sheet_music_image_new',
            group: $this->group,
            of:[
                            [
                                'type' => FieldType::Image,
                                'name' => 'Image'
                            ],
                            [
                                'type' => 'object',
                                'name' => 'URL',
                                'fields' => [
                                    [
                                        'title' => 'URL',
                                        'name' => 'url',
                                        'type' => FieldType::URL
                                    ]
                                ]
                            ]
    ]
        );
    }

}
