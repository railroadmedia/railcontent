<?php

namespace App\Modules\Content\Models\Sanity\Structure;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

/**
 * A field of a Sanity CMS document
 */
class Field
{
    //TODO:
    // - validation
    // - hidden
    // - readOnly
    // - others??

    /**
     * @param  FieldType  $type
     * @param  string  $name
     * @param  string|null  $title
     * @param  string|null  $description
     * @param  mixed|null  $initialValue
     * @param  string|null  $to
     * @param  string|null  $of
     * @param  Group|array<Group>|null  $group
     * @param  array|null  $options
     */
    public function __construct(
        public FieldType $type,
        public string $name,
        public ?string $title = null,
        public ?string $description = null,
        public mixed $initialValue = null,
        //TODO can we do something more for $to? Can at least do some validation that there exists a class with that name, that extends BaseSanityModel
        public ?string $to = null,
        //TODO can we do something more for $of?
        public ?string $of = null,
        public Group|array|null $group = null,
        public ?array $options = null
    ) {

    }

    /**
     * Get the array-formatted values for this field, so that it can be rendered
     *
     * @return array
     */
    public function toArray(): array
    {
        $required = [
            'type' => $this->type->value,
            'name' => $this->name,
        ];
        $optional = [];
        if (!is_null($this->title)) {
            $optional['title'] = $this->title;
        }
        if (!is_null($this->to)) {
            $optional['to'] = ['type' => $this->to];
        }
        if (!is_null($this->of)) {
            $optional['of'] = [['type' => $this->of]];
        }
        if (!is_null($this->options)) {
            $optional['options'] = $this->options;
        }
        if ($this->group) {
            if (is_array($this->group)) {
                $optional['group'] = array_map(function (Group $group) {
                    return $group->name;
                }, $this->group);
            } else {
                $optional['group'] = $this->group->name;
            }
        }
        return array_merge($required, $optional);
    }
}
