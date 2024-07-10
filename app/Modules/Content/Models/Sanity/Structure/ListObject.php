<?php

namespace Modules\Content\Models\Sanity\Structure;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\FormItem;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;

/**
 * A generic object that can be used to populate an array input.
 * Use the optional preview setting to customize how the item appears to the user.
 */
class ListObject extends FormItem
{
    public array $preview;

    /**
     * @param  array<Field>  $fields
     */
    public function __construct(public array $fields, private readonly null|ListItemPreview $previewItem = null)
    {
        parent::__construct(FieldType::Object);

        $this->fields = array_map(function (Field $field) {
            return $field->toArray();
        }, $this->fields);

        if ($this->previewItem) {
            $this->preview = $this->previewItem->toArray();
        }
    }
}
