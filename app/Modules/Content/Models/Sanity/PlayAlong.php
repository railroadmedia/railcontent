<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Enums\VideoType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use App\Modules\Content\Models\Sanity\Structure\Validation\Max;
use App\Modules\Content\Models\Sanity\Structure\Validation\Min;
use App\Modules\Content\Models\Sanity\Structure\Validation\Required;
use Modules\Content\Models\Sanity\Structure\Block;
use Modules\Content\Models\Sanity\Structure\BrandField;
use Modules\Content\Models\Sanity\Structure\ListObject;

/**
 * Defines the schema structure for a Play Along document type in Sanity.
 *
 * @property string       $type
 * @property string       $name
 * @property string       $title
 * @property ?string      $icon
 * @property array<Field> $fields
 */
class PlayAlong extends ParentTemplate
{
    public function __construct()
    {
        parent::__construct(self::getName(), 'Play Alongs', withResources: true);

        $detailsGroup = new Group('editorFields', 'Details', true);
        $assignmentsList = new ListObject(
            fields: [new Field(FieldType::String, 'assignment_title'),
                        new Field(FieldType::String, 'assignment_soundslice'),
                        new Field(FieldType::String, 'assignment_description'),
                        new Field(FieldType::URL, 'assignment_sheet_music_image')
                    ]
        );
        $video               = new ListObject(
            fields: [
                        new Field(FieldType::String, 'type', options: ['list' => array_column(VideoType::cases(), 'value')], validation: [new Required()]),
                        new Field(FieldType::String, 'external_id'),
                        new Field(FieldType::String, 'hlsManifestUrl'),
                        new Field(FieldType::Array, 'video_playback_endpoints', title:'video_playback_endpoints', of: new ListObject(
                            fields: [
                                        new Field(FieldType::String, 'vimeo_key'),
                                        new Field(FieldType::String, 'file'),
                                        new Field(FieldType::Number, 'height'),
                                        new Field(FieldType::Number, 'width')],
                            previewItem: new ListItemPreview('height', 'width'),
                        ), ),
                    ],

        );
        $childReference = new Reference([['type' => 'play-along-part']]);

        $this->addFields(
            [
                new Field(FieldType::Object, 'video', hidden: "({document}) => (document?.brand == 'guitareo')", fields: $video->fields, group: $detailsGroup),
                new Field(FieldType::Number, 'length_in_seconds',  hidden: "({document}) => (document?.brand == 'guitareo')", group: $detailsGroup),

                new Field(FieldType::Array, 'child', 'Lessons',  hidden: "({document}) => (document?.brand != 'guitareo')", of: $childReference, group:$detailsGroup),

                new Field(FieldType::Number, 'bpm', 'BPM', hidden: "({document}) => (document?.brand == 'guitareo')", validation: [new Min(0)], group:$detailsGroup),

                new Field(FieldType::URL, 'mp3_no_drums_no_click_url',  hidden: "({document}) => (document?.brand == 'guitareo')", group: $detailsGroup),
                new Field(FieldType::URL, 'mp3_yes_drums_no_click_url', hidden: "({document}) => (document?.brand == 'guitareo')", group: $detailsGroup),
                new Field(FieldType::URL, 'mp3_no_drums_yes_click_url', hidden: "({document}) => (document?.brand == 'guitareo')", group: $detailsGroup),
                new Field(FieldType::URL, 'mp3_yes_drums_yes_click_url', hidden: "({document}) => (document?.brand == 'guitareo')", group: $detailsGroup),
                new Field(FieldType::Array, 'assignment', 'Assignments', hidden: "({document}) => (document?.brand == 'guitareo')", of: $assignmentsList, group:$detailsGroup),
            ],
        );
    }

    public static function getName(): string
    {
        return 'play-along';
    }
}
