<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;

/**
 * Abstract class to represent a document type's schema in Sanity
 */
abstract class BaseSanityModel
{
    public string $type = 'document';

    /**
     * @param  array<Field>  $fields
     * @param  array<Group>|null  $groups
     */
    public function __construct(
        public string $name,
        public string $title,
        public array $fields,
        public ?array $groups = null,
        public ?string $icon = null,
        public ?ListItemPreview $preview = null
    ) {
    }

    /**
     * Get the name of this model (document type)
     *
     * @return string
     */
    abstract public static function getName(): string;

    /**
     * Get the array-formatted values for this schema, so that it can be rendered
     *
     * @return array
     */
    public function toArray(): array
    {
        $required = [
            'type' => $this->type,
            'name' => $this->name,
            'title' => $this->title,
            'fields' => array_map(function (Field $field) {
                return $field->toArray();
            }, $this->fields)
        ];

        $optional = [];
        if ($this->groups) {
            $optional['groups'] = array_map(function (Group $group) {
                return $group->toArray();
            }, $this->groups);
        }
        if ($this->preview) {
            $optional['preview'] = $this->preview->toArray();
        }
        return array_merge($required, $optional);
    }
}
