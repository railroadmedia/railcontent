<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use Modules\Content\Models\Sanity\Structure\ListObject;

/**
 * Defines the schema structure for a License document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class License extends BaseSanityModel
{
    public function __construct()
    {
        $detailsGroup = new Group('editorFields', 'Details', true);
        $publisherGroup = new Group('publisherFields', 'Publishers');
        $contentGroup = new Group('contentFields', 'Linked Content');
        $groups = [
            $detailsGroup,
            $publisherGroup,
            $contentGroup
        ];

        $publisherList = new ListObject(
            fields: [
                new Field(FieldType::Reference, 'publisher', 'Publisher', to: 'publisher', validation: BaseSanityModel::RULE_REQUIRED),
                new Field(FieldType::Number, 'license_percent', validation: "rule => rule.required().min(.01).max(1).precision(2)")
            ],
            previewItem: new ListItemPreview('publisher.name', 'license_percent')
        );

        $contentList = new ListObject(
            fields: [new Field(FieldType::String, 'content_id')],
            previewItem: new ListItemPreview('content_id')
        );

        $fields = [
            new Field(FieldType::Array, 'content_id', "Content", of: $contentList, group: $detailsGroup),
            new Field(FieldType::String, 'song_name', "Song Name", validation: BaseSanityModel::RULE_REQUIRED, group: $detailsGroup),
            new Field(FieldType::String, 'song_artist', "Artist", validation: BaseSanityModel::RULE_REQUIRED, group: $detailsGroup),
            new Field(FieldType::String, 'risk', "Risk", validation: BaseSanityModel::RULE_REQUIRED, group: $detailsGroup, options: [
                'list' => ['blue', 'red'],
                'layout' => 'dropdown'
            ]),
            new Field(FieldType::String, 'mlc', "MLC", validation: BaseSanityModel::RULE_REQUIRED, group: $detailsGroup),
            new Field(FieldType::String, 'iswc', 'ISWC', group: $detailsGroup),
            new Field(FieldType::String, 'isrc', 'ISRC', group: $detailsGroup),
            new Field(FieldType::Boolean, 'public_domain', 'Is In Public Domain', validation: BaseSanityModel::RULE_REQUIRED, group: $detailsGroup),
            new Field(FieldType::Array, 'license', 'Licenses', of: $publisherList, group: $publisherGroup),
        ];
        $preview = new ListItemPreview('song_name', 'song_artist');
        parent::__construct('license', 'License', fields: $fields, preview: $preview, groups: $groups);
    }
    public static function getName(): string
    {
        return 'License';
    }
}
