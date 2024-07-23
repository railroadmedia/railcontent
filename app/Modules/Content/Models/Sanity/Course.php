<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use Modules\Content\Models\Sanity\Structure\Block;
use Modules\Content\Models\Sanity\Structure\BrandField;
use Modules\Content\Models\Sanity\Structure\ListObject;

/**
 * Defines the schema structure for a Course document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Course extends BaseSanityModel
{
    public function __construct()
    {
        $childReference = new Reference([['type' => 'course-part']],options: ['rox_fied' => "document.title"]);
        $topicReference = new Reference([['type' => 'topic']], options: ['disableNew' => false]);
        $instructorReference = new Reference([['type' => 'instructor']]);
        $permissionReference = new Reference([['type' => 'permission']], options: ['disableNew' => false]);
        $topicReference = new Reference([['type' => 'topic']], options: ['disableNew' => false]);
        $blockList = new Block();
        $resourceList = new ListObject(
            fields: [new Field(FieldType::String, 'resource_name'),
                        new Field(FieldType::URL, 'resource_url')],
            previewItem: new ListItemPreview('resource_name', 'resource_url')
        );

        $detailsGroup = new Group('editorFields', 'Details', true);
        $openAIGroup = new Group('openAI', 'OpenAI');
        $groups = [
            $detailsGroup,
            $openAIGroup
        ];

        $fields = [
            new Field(FieldType::String, 'title', validation: "(rule) => rule.required()",group:$detailsGroup),
            new Field(FieldType::Slug, 'slug', options:['source' => 'title','isUnique'=>'IsUniqueAcrossBrand'], hidden: "({document}) => !document?.title,", group:$detailsGroup),
            new BrandField($detailsGroup),
            new Field(FieldType::Datetime, 'published_on', options: ['dateformat' => 'YYYY-MM-DD '], group:$detailsGroup),
            new Field(FieldType::Array, 'permission', 'Permissions', of: $permissionReference, inputComponent: 'RolesBasedPermissionsInput',group:$detailsGroup),
            new Field(FieldType::Array, 'instructor', 'Instructor', '', of: $instructorReference,group:$detailsGroup),
            new Field(FieldType::Array, 'description', 'Description', of:$blockList, group:$detailsGroup),
            new Field(
                FieldType::Number,
                'difficulty',
                validation: "rule => rule.min(0).max(10)",
                inputComponent: 'DifficultyInput',group:$detailsGroup
            ),
            new Field(FieldType::String, 'difficulty_string', 'Difficulty String', readOnly: "true",group:$detailsGroup),
            new Field(FieldType::Number, 'xp', 'XP', validation: "rule => rule.min(0)",group:$detailsGroup),
            new Field(FieldType::Number, 'total_xp', 'Total XP', hidden: "({document}) => !document?.xp", readOnly: "true",group:$detailsGroup),
            new Field(FieldType::String, 'difficulty_ai', 'Difficulty AI', inputComponent: 'OpenAiInput', group:$openAIGroup),
            new Field(FieldType::Array, 'topic', 'Topic', '', of: $topicReference,group:$detailsGroup),
            new Field(FieldType::Boolean, 'show_in_new_feed', 'Show in New feed',group:$detailsGroup),
            new Field(FieldType::Boolean, 'is_featured', 'Feature in coach/instructor "Featured Lessons" list',group:$detailsGroup),
            new Field(FieldType::Boolean, 'hide_from_recsys', 'Hide from recsys',group:$detailsGroup),
            new Field(FieldType::Number, 'child_count', 'Child count', group:$detailsGroup),
            new Field(FieldType::Image, 'thumbnail', 'Thumbnail',group:$detailsGroup),
            new Field(FieldType::Array, 'resource', 'Resources', of: $resourceList,group:$detailsGroup),
            new Field(FieldType::Array, 'child', 'Lessons', '', of: $childReference,group:$detailsGroup),
            new Field(FieldType::Number, 'railcontent_id', 'MWP Railcontent ID', readOnly: "true",group:$detailsGroup), //web_url_path
            new Field(FieldType::String, 'web_url_path', 'MWP web_url_path', readOnly: "true",group:$detailsGroup),
            new Field(FieldType::String, 'language', 'Language', hidden: "true",group:$detailsGroup),
            new Field(FieldType::Number, 'popularity', 'Popularity', readOnly: "true",group:$detailsGroup), //web_url_path
        ];
        $preview = new ListItemPreview('title', 'brand', 'thumbnail');
        parent::__construct(self::getName(), 'Course', fields: $fields, preview: $preview, groups: $groups);
    }

    public static function getName(): string
    {
        return 'course';
    }
}
