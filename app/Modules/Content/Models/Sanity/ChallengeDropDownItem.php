<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Validation\Required;

/**
 * Defines the schema structure for an Artist document type in Sanity.
 *
 * @property string $type
 * @property string $name
 * @property string $title
 * @property ?string $icon
 * @property array<Field> $fields
 */
class ChallengeDropDownItem extends BaseSanityModel
{
    public function __construct()
    {
        $fields = [
            new Field(FieldType::String, 'title', "Title", validation: [new Required()]),
            new Field(FieldType::String, 'description', "Description", validation: [new Required()]),
        ];
        parent::__construct('challengeDropDownItem', 'Challenge Drop Down Item', $fields);
        $this->type = 'object';
    }

    /**
     * @inheritDoc
     */
    public static function getName(): string
    {
        return 'challengeDropDownItem';
    }
}
