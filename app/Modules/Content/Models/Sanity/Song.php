<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use Modules\Content\Models\Sanity\Structure\ListObject;

/**
 * Defines the schema structure for a Song document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class Song extends BaseSanityContentTypeModel
{
    public function __construct()
    {
        $genreReference = new Reference([['type' => 'genre']], options: ['aiAssist' => ['embeddingsIndex' => 'genre-index']]);

        $resourceList = new ListObject(
            fields: [new Field(FieldType::String, 'resource_name'),
                        new Field(FieldType::URL, 'resource_url')],
            previewItem: new ListItemPreview('resource_name', 'resource_url')
        );
        $soundsliceList = new ListObject(
            fields: [new Field(FieldType::String, 'soundslice_title'),
                new Field(FieldType::String, 'soundslice_slug', inputComponent: 'SoundsliceSlugInput'),
                new Field(FieldType::Number, 'soundslice_length_in_second')],
            previewItem: new ListItemPreview('soundslice_title', 'soundslice_slug')
        );

        $detailsGroup = new Group('editorFields', 'Details', true);
        $openAIGroup = new Group('openAI', 'OpenAI');
        $groups = [
            $detailsGroup,
            $openAIGroup,
        ];
        $defaultFields = $this->getCommonFields($detailsGroup, includeDescription: false);

        $fields = [
            new Field(FieldType::Number, 'released', 'Year Released', validation: "rule => rule.min(0).max(new Date().getFullYear())", group:$detailsGroup),
            new Field(FieldType::String, 'released_year_ai', 'Year Released AI', inputComponent: 'OpenAiInput', group:$openAIGroup),
            new Field(FieldType::String, 'difficulty_ai', 'Difficulty AI', inputComponent: 'OpenAiInput', group:$openAIGroup),
            new Field(FieldType::String, 'genre_ai', 'Genre AI', inputComponent: 'OpenAiInput', group:$openAIGroup),
            new Field(FieldType::String, 'album', group:$detailsGroup),
            new Field(FieldType::String, 'transcriber_name', 'Transcribed By', group:$detailsGroup),
            new Field(FieldType::Boolean, 'instrumentless', 'Is instrumentless', group:$detailsGroup),
            new Field(FieldType::Boolean, 'show_in_new_feed', 'Show in new feed', group:$detailsGroup),
            new Field(FieldType::Reference, 'artist', 'Artist', '', to: 'artist', options: ['aiAssist' => ['embeddingsIndex' => 'artists-index']], group:$detailsGroup),
            new Field(FieldType::Array, 'genre', 'Genre', '', of: $genreReference, group:$detailsGroup),
            new Field(FieldType::Array, 'soundslice', 'Soundslice', of: $soundsliceList, inputComponent: 'ArrayInput', group:$detailsGroup),
            new Field(FieldType::Number, 'child_count', 'Child count', hidden: "true", readOnly: "true", group:$detailsGroup),
            new Field(FieldType::Array, 'resource', 'Resources', of: $resourceList, group:$detailsGroup),
            new Field(FieldType::String, 'language', 'Language', hidden: "true", group:$detailsGroup),
            new Field(FieldType::Number, 'popularity', 'Popularity', readOnly: "true", group:$detailsGroup), //web_url_path
        ];
        $fields = array_merge($defaultFields, $fields);
        parent::__construct(self::getName(), 'Song', fields: $fields, groups: $groups, preview: $this->getDefaultPreview());
    }

    /**
     * @inheritDoc
     */
    public static function getName(): string
    {
        return 'song';
    }
}
