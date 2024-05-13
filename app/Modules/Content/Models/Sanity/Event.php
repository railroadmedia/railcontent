<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;

/**
 * Defines the schema structure for a Post document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Event extends BaseSanityModel
{
    // DELETEME - just here for a test of the Day One With Sanity lesson
    public function __construct()
    {
        $detailsGroup = new Group('details', 'Details');
        $editorialGroup = new Group('editorial', 'Editorial');
        $groups = [
            $detailsGroup,
            $editorialGroup,
        ];

        $fields = [
            new Field(FieldType::String, 'name', group:$groups),
            new Field(FieldType::Slug, 'slug', group:$detailsGroup, options:['source' => 'name']),
            new Field(FieldType::String, 'eventType', group:$detailsGroup, options:['list' => ['in-person', 'virtual'],
                'layout' => 'radio']),
            new Field(FieldType::Datetime, 'date', group:$detailsGroup),
            new Field(FieldType::Number, 'doorsOpen', description:'Number of minutes before the start time for admission', initialValue:60, group:$detailsGroup),
            new Field(FieldType::Reference, 'venue', to:'venue', group:$detailsGroup),
            new Field(FieldType::Reference, 'headline', to:'artist', group:$detailsGroup),
            new Field(FieldType::Image, 'image', group:$editorialGroup),
            // TODO NOTE: this causes an error: Error: Cannot read properties of null (reading 'useMemo')
            // because it's missing a React component. That's out of scope for this, so just ignore the details section
            // new Field(FieldType::Array, 'details', of:'block', group:$editorialGroup),
            new Field(FieldType::URL, 'tickets', group:$detailsGroup),
        ];
        parent::__construct('event', 'Event', $fields, $groups);
    }
}
